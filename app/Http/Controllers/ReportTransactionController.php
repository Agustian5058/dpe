<?php

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\Customer;
use App\Models\VehicleArrival;
use App\Models\Vehicle;
use App\Models\TransactionType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\TransactionExport;
use App\Exports\TransactionExportView;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ReportTransactionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Laporan Transaksi");
            $dataTransactions = Transaction::join("customers", "transactions.transaction_customer", "=", "customers.customer_id")
            ->join("vehicle_arrivals", "transactions.transaction_vehicle_arrival", "=", "vehicle_arrivals.arrival_id")
            ->join("vehicles", "vehicle_arrivals.arrival_vehicle", "=", "vehicles.vehicle_id")
            ->get(["transactions.*", "customers.customer_name", "customers.customer_sales", "vehicles.vehicle_name"]);
            $dataCustomers = Customer::orderBy("customer_name")->get();
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataTransactionTypes = TransactionType::orderBy("transaction_name")->get();
            $dataSaless = Sales::orderBy("sales_id")->get();
            return view("reporttransaction", compact("dataTransactions", "dataCustomers", "dataArrivals", "dataTransactionTypes", "dataSaless"));
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Laporan Transaksi");
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $sales_id = $request->sales_id;
            $arrival_id = $request->arrival_id;
            $customer_id = $request->customer_id;
            $transaction_name = $request->transaction_name;
            if (empty($from_date) && empty($to_date) && empty($sales_id) && empty($arrival_id) && empty($customer_id) && empty($transaction_name)){
                return redirect("/reporttransaction");
            }
            $dataTransactions = Transaction::join("customers", "transactions.transaction_customer", "=", "customers.customer_id")
            ->join("vehicle_arrivals", "transactions.transaction_vehicle_arrival", "=", "vehicle_arrivals.arrival_id")
            ->join("vehicles", "vehicle_arrivals.arrival_vehicle", "=", "vehicles.vehicle_id");
            if($from_date){
                $dataTransactions = $dataTransactions->whereDate("transaction_date", ">=", $from_date);
                $request->session()->flash("from_date", $from_date);
            }
            if($to_date){
                $dataTransactions = $dataTransactions->whereDate("transaction_date", "<=", $from_date);
                $request->session()->flash("to_date", $to_date);
            }
            if($sales_id){
                $dataTransactions = $dataTransactions->where("customer_sales", $sales_id);
                $dataSales = Sales::where("sales_id", $sales_id)->orderBy("sales_id")->firstOrFail();
                $request->session()->flash("dataSales", $dataSales);
            }
            if($arrival_id){
                $dataTransactions = $dataTransactions->where("transaction_vehicle_arrival", $arrival_id);
                $dataArrival = VehicleArrival::where("arrival_id", $arrival_id)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"])->firstOrFail();
                $request->session()->flash("dataArrival", $dataArrival);
            }
            if($customer_id){
                $dataTransactions = $dataTransactions->where("transaction_customer", $customer_id);
                $dataCustomer = Customer::where("customer_id", $customer_id)->orderBy("customer_id")->firstOrFail();
                $request->session()->flash("dataCustomer", $dataCustomer);
            }
            if($transaction_name){
                $dataTransactions = $dataTransactions->where("transaction_transaction_type", $transaction_name);
                $dataTransactionType = TransactionType::where("transaction_name", $transaction_name)->orderBy("transaction_name")->firstOrFail();
                $request->session()->flash("dataTransactionType", $dataTransactionType);
            }
            $dataTransactions = $dataTransactions->get(["transactions.*", "customers.customer_name", "customers.customer_sales", "vehicles.vehicle_name"]);
            $dataCustomers = Customer::orderBy("customer_name")->get();
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataTransactionTypes = TransactionType::orderBy("transaction_name")->get();
            $dataSaless = Sales::orderBy("sales_id")->get();
            return view("reporttransaction", compact("dataTransactions", "dataCustomers", "dataArrivals", "dataTransactionTypes", "dataSaless"));
        } else {
            return redirect("/login");
        }
    }

    public function exportexcel(){
        return Excel::download(new TransactionExportView(), "transaction.xlsx");
    }
}