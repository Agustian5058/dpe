<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Sales;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Customer");
            $dataCustomers = Customer::latest()->paginate(10);
            $dataSaless = Sales::latest()->paginate(10);
            return view("customer", compact("dataCustomers", "dataSaless"));
        } else {
            return view("login");
        }
    }
    
    public function edit(Request $request, $customer_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Customer");
            $dataCustomer = Customer::where("customer_id", $customer_id)->firstOrFail();
            $dataSaless = Sales::latest()->paginate(10);
            return view("customer_update", compact("dataCustomer", "dataSaless"));
        } else {
            return view("login");
        }
    }

    public function show(Request $request, $customer_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Customer");
            $dataCustomers = Customer::where("customer_id", $customer_id)->firstOrFail();
            $dataSaless = Sales::latest()->paginate(10);
            return view("customer", compact("dataCustomers", "dataSaless"));
        } else {
            return view("login");
        }
    }

    public function update(Request $request, $customer_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "customer_id"           => "required",
                "customer_name"         => "required",
                "customer_sales"        => "required",
                "customer_address"      => "",
                "customer_province"     => "",
                "customer_city"         => "",
                "customer_phone"        => "",
                "customer_postal_code"  => "",
                "customer_fax"          => "",
            ]);
            $dataCustomer = Customer::where("customer_id", $request->customer_id)->firstOrFail();
            $dataCustomer->update([
                "customer_name"         => $request->customer_name,
                "customer_address"      => $request->customer_address,
                "customer_province"     => $request->customer_province,
                "customer_city"         => $request->customer_city,
                "customer_phone"        => $request->customer_phone,
                "customer_postal_code"  => $request->customer_postal_code,
                "customer_fax"          => $request->customer_fax,
                "updated_by"            => session("id")
            ]);
            $request->session()->put("pagename", "Customer");
            $request->session()->flash("message", "Customer " . $request->customer_id . " " . $request->customer_name . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/customer");
        } else {
            return view("login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "customer_id"           => "required",
                "customer_name"         => "required",
                "customer_sales"        => "required",
                "customer_address"      => "",
                "customer_province"     => "",
                "customer_city"         => "",
                "customer_phone"        => "",
                "customer_postal_code"  => "",
                "customer_fax"          => "",
            ]);
            Customer::create([
                "customer_sales"        => $request->customer_sales,
                "customer_id"           => $request->customer_id,
                "customer_name"         => $request->customer_name,
                "customer_address"      => $request->customer_address,
                "customer_province"     => $request->customer_province,
                "customer_city"         => $request->customer_city,
                "customer_phone"        => $request->customer_phone,
                "customer_postal_code"  => $request->customer_postal_code,
                "customer_fax"          => $request->customer_fax,
                "created_by"            => session("id")
            ]);
            $request->session()->put("pagename", "Customer");
            $request->session()->flash("message", "Customer " . $request->customer_id . " " . $request->customer_name . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/customer");
        } else {
            return view("login");
        }
    }
    
    public function destroy(Request $request, $customer_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Customer");
            $dataCustomers = Customer::where("customer_id", $customer_id)->firstOrFail();
            $request->session()->flash("message", "Customer " . $request->customer_id . " " . $request->customer_name . " Telah Dihapus");
            $request->session()->flash("status", "success");
            $dataCustomers->delete();
            return redirect("/customer");
        } else {
            return view("login");
        }
    }
}


