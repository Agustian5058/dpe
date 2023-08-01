<?php

namespace App\Http\Controllers;
use App\Models\Sales;
use App\Models\Customer;
use App\Models\VehicleArrival;
use App\Models\Vehicle;
use App\Models\TransactionType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use App\Exports\CustomerExportView;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ReportCustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Laporan Customer");

            $saldoAwal = "(select transaction_customer, previous_amount 
            from (select transaction_customer, previous_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id ASC) rn from transactions) as t1 
            where rn = 1) as t1";
            $saldoAkhir = "(select transaction_customer, current_amount 
            from (select transaction_customer, current_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id DESC) rn from transactions) as t2
            where rn = 1) as t2";
            $totalDebit = "(select transaction_customer, SUM(price) as total_debit 
            from transactions where transaction_debit_credit='Debit' GROUP BY transaction_customer) as t3";
            $totalCredit = "(select transaction_customer, SUM(price) as total_credit 
            from transactions where transaction_debit_credit='Credit' GROUP BY transaction_customer) as t4";
            $dataCustomers = Customer::join(DB::raw($saldoAwal), "customers.customer_id", "=", "t1.transaction_customer")
            ->join(DB::raw($saldoAkhir), "customers.customer_id", "=", "t2.transaction_customer")
            ->join(DB::raw($totalDebit), "customers.customer_id", "=", "t3.transaction_customer")
            ->join(DB::raw($totalCredit), "customers.customer_id", "=", "t4.transaction_customer")
            ->orderBy("customer_name")
            ->get();
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataSaless = Sales::orderBy("sales_id")->get();
            return view("reportcustomer", compact("dataCustomers", "dataSaless", "dataArrivals"));
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Laporan Customer");
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $sales_id = $request->sales_id;
            $arrival_id = $request->arrival_id;
            $customer_id = $request->customer_id;
            $transaction_name = $request->transaction_name;
            if (empty($from_date) && empty($to_date) && empty($sales_id) && empty($arrival_id) && empty($customer_id) && empty($transaction_name)){
                return redirect("/reportcustomer");
            }
            $saldoAwal = "(select transaction_customer, previous_amount 
            from (select transaction_customer, previous_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id ASC) rn from transactions) as t1 
            where rn = 1) as t1";
            $saldoAkhir = "(select transaction_customer, current_amount 
            from (select transaction_customer, current_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id DESC) rn from transactions) as t2
            where rn = 1) as t2";
            $totalDebit = "(select transaction_customer, SUM(price) as total_debit 
            from transactions where transaction_debit_credit='Debit' GROUP BY transaction_customer) as t3";
            $totalCredit = "(select transaction_customer, SUM(price) as total_credit 
            from transactions where transaction_debit_credit='Credit' GROUP BY transaction_customer) as t4";
            
            if(($from_date) || ($to_date)){
                $request->session()->flash("from_date", $from_date);
                $request->session()->flash("to_date", $to_date);
                $saldoAwal = "(select transaction_customer, previous_amount 
                from (select transaction_customer, previous_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id ASC) rn 
                from transactions";
                $saldoAkhir = "(select transaction_customer, previous_amount 
                from (select transaction_customer, current_amount, ROW_NUMBER() OVER(PARTITION BY transaction_customer ORDER BY transaction_id DESC) rn 
                from transactions";
                if ($from_date && $to_date){
                    $saldoAwal = $saldoAwal . "where transaction_date <= ".$from_date." AND transaction_date <= ".$to_date;
                    $saldoAkhir = $saldoAkhir . "where transaction_date <= ".$from_date." AND transaction_date <= ".$to_date;
                } else{
                    if ($from_date){
                        $saldoAwal = $saldoAwal . "where transaction_date >= ".$from_date;
                        $saldoAkhir = $saldoAkhir . "where transaction_date >= ".$from_date;
                    }
                    if ($to_date){
                        $saldoAwal = $saldoAwal . "where transaction_date <= ".$to_date;
                        $saldoAkhir = $saldoAkhir . "where transaction_date <= ".$to_date;
                    }
                }
                $saldoAwal = $saldoAwal . ")where rn = 1) as t1";
                $saldoAwal = $saldoAwal . ")where rn = 1) as t2";
            }
            $dataCustomers = Customer::join(DB::raw($saldoAwal), "customers.customer_id", "=", "t1.transaction_customer")
            ->join(DB::raw($saldoAkhir), "customers.customer_id", "=", "t2.transaction_customer")
            ->join(DB::raw($totalDebit), "customers.customer_id", "=", "t3.transaction_customer")
            ->join(DB::raw($totalCredit), "customers.customer_id", "=", "t4.transaction_customer")
            ->orderBy("customer_name");
            if($sales_id){
                $dataCustomers = $dataCustomers->where("customer_sales", $sales_id);
                $dataSales = Sales::where("sales_id", $sales_id)->orderBy("sales_id")->firstOrFail();
                $request->session()->flash("dataSales", $dataSales);
            }
            if($customer_id){
                $dataCustomers = $dataCustomers->where("customer_sales", $sales_id);
                $dataCustomer = Customer::where("customer_id", $customer_id)->orderBy("customer_id")->firstOrFail();
                $request->session()->flash("dataCustomer", $dataCustomer);
            }
            $dataCustomers = $dataCustomers->get();
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy("vehicles.vehicle_id")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataSaless = Sales::orderBy("sales_id")->get();
            return view("reportcustomer", compact("dataCustomers", "dataArrivals", "dataSaless"));
        } else {
            return redirect("/login");
        }
    }

    public function exportexcel(){
        return Excel::download(new CustomerExportView(), "customer.xlsx");
    }
}
