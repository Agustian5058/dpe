<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Sales");
            $dataSaless = Sales::latest()->paginate(10);
            return view("sales", compact("dataSaless"));
        } else {
            return view("login");
        }
    }
    
    public function edit(Request $request, $sales_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Sales");
            $dataSales = Sales::where("sales_id", $sales_id)->firstOrFail();
            return view("sales_update", compact("dataSales"));
        } else {
            return view("login");
        }
    }

    public function show(Request $request, $sales_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Sales");
            $dataSaless = Sales::where("sales_id", $sales_id)->firstOrFail();
            return view("sales", compact("dataSaless"));
        } else {
            return view("login");
        }
    }

    public function update(Request $request, $sales_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "sales_id"          => "required",
                "sales_name"        => "required",
                "sales_description" => "",
            ]);
            $dataSales = Sales::where("sales_id", $request->sales_id)->firstOrFail();
            $dataSales->update([
                "sales_name"        => $request->sales_name,
                "sales_description" => $request->sales_description,
                "updated_by"        => session("id")
            ]);
            $request->session()->put("pagename", "Sales");
            $request->session()->flash("message", "Sales " . $request->sales_id . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/sales");
        } else {
            return view("login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "sales_id"          => "required",
                "sales_name"        => "required",
                "sales_description" => "",
            ]);
            Sales::create([
                "sales_id"          => $request->sales_id,
                "sales_name"        => $request->sales_name,
                "sales_description" => $request->sales_description,
                "created_by"        => session("id")
            ]);
            $request->session()->put("pagename", "Sales");
            $request->session()->flash("message", "Sales " . $request->username . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/sales");
        } else {
            return view("login");
        }
    }
}


