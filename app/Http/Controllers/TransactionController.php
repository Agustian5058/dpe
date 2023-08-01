<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\VehicleArrival;
use App\Models\Vehicle;
use App\Models\TransactionType;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Transaksi Piutang");
            $dataTransactions = Transaction::join("customers", "transactions.transaction_customer", "=", "customers.customer_id")
            ->join("vehicle_arrivals", "transactions.transaction_vehicle_arrival", "=", "vehicle_arrivals.arrival_id")
            ->join("vehicles", "vehicle_arrivals.arrival_vehicle", "=", "vehicles.vehicle_id")
            ->get(["transactions.*", "customers.customer_name", "vehicles.vehicle_name"]);
            $dataCustomers = Customer::orderBy("customer_name")->get();
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataTransactionTypes = TransactionType::orderBy("transaction_name")->get();
            return view("transaction", compact("dataTransactions", "dataCustomers", "dataArrivals", "dataTransactionTypes"));
        } else {
            return redirect("/login");
        }
    }
    public function transaction_check($transaction_id, $transaction_date){
        $date1 = date("Y-m-d");
        $diff = date_diff(date_create($date1), date_create($transaction_date));
        if($diff->days >= 30){
            $request->session()->put("pagename", "Transaksi Piutang");
            $request->session()->flash("message", "Transaksi " . $request->transaction_id . " sudah lewat 30 hari. Tidak bisa dirubah");
            $request->session()->flash("status", "error");
            return redirect("/transaction");
        }
        return;
    }
    public function edit(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Transaksi Piutang");
            $dataTransaction = Transaction::where("transaction_id", $transaction_id)
            ->join("customers", "transactions.transaction_customer", "=", "customers.customer_id")
            ->join("vehicle_arrivals", "transactions.transaction_vehicle_arrival", "=", "vehicle_arrivals.arrival_id")
            ->join("vehicles", "vehicle_arrivals.arrival_vehicle", "=", "vehicles.vehicle_id")
            ->get(["transactions.*", "customers.customer_name", "vehicles.vehicle_name"])->firstOrFail();
            self::transaction_check($dataTransaction->transaction_id, $dataTransaction->transaction_date);
            $dataTransactionType = TransactionType::where("transaction_name", $dataTransaction->transaction_transaction_type)->firstOrFail();
            $dataCustomer = Customer::where("customer_id", $dataTransaction->transaction_customer)->firstOrFail();
            $dataArrival = VehicleArrival::where("arrival_id", $dataTransaction->transaction_vehicle_arrival)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"])->firstOrFail();
            return view("transaction_update", compact("dataTransaction", "dataTransactionType", "dataCustomer", "dataArrival"));
        } else {
            return redirect("/login");
        }
    }
    public function show(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Transaksi Piutang");
            $dataArrivals = VehicleArrival::where("transaction_id", $transaction_id)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_transactions.transaction_vehicle")->get(["vehicle_transactions.*", "vehicles.vehicle_name"])->firstOrFail();
            $dataVehicles = Vehicle::latest()->paginate(10);
            return view("transaction", compact("dataArrivals", "dataVehicles"));
        } else {
            return redirect("/login");
        }
    }
    public function rollback_transaction($customer_id, $from){
        $previous_price;
        $current_price;
        $dataTransactions = Transaction::where([["transaction_customer", "=", $customer_id], ["transaction_date", ">=", $from]])->orderBy("transaction_id")->get();
        foreach ($dataTransactions as $dataTransaction) {
            if (empty($previous_price)){
                $previous_price = $dataTransaction->previous_amount;
            }
            if ($dataTransaction->transaction_debit_credit == ("Credit")){
                $current_price = $previous_price - $dataTransaction->price;
            }else{
                $current_price = $previous_price + $dataTransaction->price;
            }
            $dataTransaction->update([
                "previous_amount"   => $previous_price,
                "current_amount"    => $current_price,
                "updated_by"        => session("id")
            ]);
            $previous_price = $current_price;
        }
        $dataCustomer = Customer::where("customer_id", $dataTransaction->transaction_customer)->firstOrFail();
        $dataCustomer->update([
            "amount"        => $current_price,
            "updated_by"    => session("id")
        ]);
        return;
    }
    public function update(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "transaction_id"    => "required",
                "note"              => "required",
                "price"             => "required",
            ]);
            $dataTransaction = Transaction::where("transaction_id", $transaction_id)->firstOrFail();
            self::transaction_check($dataTransaction->transaction_id, $dataTransaction->transaction_date);
            $dataCustomer = Customer::where("customer_id", $dataTransaction->transaction_customer)->firstOrFail();
            $previous_price = $dataTransaction->price;
            $dataTransaction->update([
                "transaction_container_number"  => $request->transaction_container_number,
                "goods_type"                    => $request->goods_type,
                "feet"                          => $request->feet,
                "qty"                           => $request->qty,
                "price"                         => $request->price,
                "note"                          => $request->note,
                "updated_by"                    => session("id")
            ]);
            if($previous_price != $request->price){
                $this::rollback_transaction($dataTransaction->transaction_customer, $dataTransaction->transaction_date);
            }
            $request->session()->put("pagename", "Transaksi Piutang");
            $request->session()->flash("message", "Transaksi " . $request->transaction_id . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/transaction");
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "arrival_id"                    => "required",
                "customer_id"                   => "required",
                "transaction_name"              => "required",
                "note"                          => "required",
                "price"                         => "required",
            ]);
            $dataTransactionType = TransactionType::where("transaction_name", $request->transaction_name)->firstOrFail();
            $dataCustomer = Customer::where("customer_id", $request->customer_id)->firstOrFail();
            $dataArrival = VehicleArrival::where("arrival_id", $request->arrival_id)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"])->firstOrFail();
            $transaction_id = $request->customer_id . "-" .time();
            $current_amount = 0;
            if ($dataTransactionType->transaction_debit_credit == ("Credit")){
                $current_amount = $dataCustomer->amount - $request->price;
            }else{
                $current_amount = $dataCustomer->amount + $request->price;
            }
            Transaction::create([
                "transaction_id"                => $transaction_id,
                "transaction_date"              => date("Y-m-d"),
                "transaction_container_number"  => $request->transaction_container_number,
                "goods_type"                    => $request->goods_type,
                "feet"                          => $request->feet,
                "qty"                           => $request->qty,
                "price"                         => $request->price,
                "note"                          => $request->note,
                "transaction_debit_credit"      => $dataTransactionType->transaction_debit_credit,
                "transaction_transaction_type"  => $request->transaction_name,
                "transaction_vehicle_arrival"   => $request->arrival_id,
                "transaction_customer"          => $request->customer_id,
                "previous_amount"               => $dataCustomer->amount,
                "current_amount"                => $current_amount,
                "created_by"                    => session("id")
            ]);
            $dataCustomer->update([
                "amount"        => $current_amount,
                "updated_by"    => session("id")
            ]);
            $request->session()->put("pagename", "Transaksi Piutang");
            $request->session()->flash("dataArrival", $dataArrival);
            $request->session()->flash("dataCustomer", $dataCustomer);
            $request->session()->flash("dataTransactionType", $dataTransactionType);
            $request->session()->flash("message", "Transaksi " . $transaction_id . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/transaction");
        } else {
            return redirect("/login");
        }
        
    }

    public function destroy(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Transaksi Piutang");
            $dataTransaction = Transaction::where("transaction_id", $transaction_id)->firstOrFail();
            $request->session()->flash("message", "Transaksi " . $request->transaction_id . " Telah Dihapus");
            $request->session()->flash("status", "success");
            $dataTransaction->delete();
            return redirect("/transaction");
        } else {
            return redirect("/login");
        }
    }
}
