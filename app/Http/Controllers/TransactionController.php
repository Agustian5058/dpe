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
            return view("login");
        }
    }
    
    public function edit(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Transaksi Piutang");
            $dataTransactions = Transaction::where("transaction_id", $transaction_id)
            ->join("arrivals", "arrivals.arrival_id", "=", "transactions.transaction_vehicle_arrival")
            ->join("vehicles", "vehicles.vehicle_id", "=", "arrivals.arrival_vehicle")
            ->join("customers", "customers.customer_id", "=", "transactions.transaction_customer")
            ->join("transaction_types", "transaction_types.transaction_name", "=", "transactions.transaction_transaction_type")
            ->get(["transactions.*", "arrivals.arrival_date", "vehicles.vehicle_name", "customers.customer_name"])->firstOrFail();
            return view("transaction_update", compact("dataArrival", "dataVehicles"));
        } else {
            return view("login");
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
            return view("login");
        }
    }

    public function update(Request $request, $transaction_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "transaction_id"        => "required",
                "transaction_date"      => "required",
                "transaction_vehicle"   => "required"
            ]);
            $dataArrival = VehicleArrival::where("transaction_id", $request->transaction_id)->firstOrFail();
            $dataArrival->update([
                "transaction_date"      => $request->transaction_date,
                "transaction_vehicle"   => $request->transaction_vehicle,
                "updated_by"        => session("id")
            ]);
            $request->session()->put("pagename", "Transaksi Piutang");
            $request->session()->flash("message", "Kedatangan Kendaraan " . $request->transaction_id . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/transaction");
        } else {
            return view("login");
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
            $transaction_id = $request->customer_id . "-". session("id") . "-" .time();
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
                "created_by"                    => session("id")
            ]);
            $request->session()->put("pagename", "Transaksi Piutang");
            $request->session()->flash("dataArrival", $dataArrival);
            $request->session()->flash("dataCustomer", $dataCustomer);
            $request->session()->flash("dataTransactionType", $dataTransactionType);
            $request->session()->flash("message", "Transaksi " . $transaction_id . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/transaction");
        } else {
            return view("login");
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
            return view("login");
        }
    }
}
