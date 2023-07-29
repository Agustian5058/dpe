<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Dashboard");
            return view("dashboard");
        } else {
            return redirect("/login");
        }
    }

    public function show(Request $request)
    {
        if ($request->session()->has("username")) {
            return view("dashboard");
        } else {
            return redirect("/login");
        }
    }
}
