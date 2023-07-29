<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kapal");
            $dataVehicles = Vehicle::latest()->paginate(10);
            return view("vehicle", compact("dataVehicles"));
        } else {
            return redirect("/login");
        }
    }
    
    public function edit(Request $request, $vehicle_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kapal");
            $dataVehicle = Vehicle::where("vehicle_id", $vehicle_id)->firstOrFail();
            return view("vehicle_update", compact("dataVehicle"));
        } else {
            return redirect("/login");
        }
    }

    public function show(Request $request, $vehicle_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kapal");
            $dataVehicles = Vehicle::where("vehicle_id", $vehicle_id)->firstOrFail();
            return view("vehicle", compact("dataVehicles"));
        } else {
            return redirect("/login");
        }
    }

    public function update(Request $request, $vehicle_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "vehicle_id"    => "required",
                "vehicle_type"  => "required",
                "vehicle_name"  => "required",
            ]);
            $dataVehicle = Vehicle::where("vehicle_id", $request->vehicle_id)->firstOrFail();
            $dataVehicle->update([
                "vehicle_type"  => $request->vehicle_type,
                "vehicle_name"  => $request->vehicle_name,
                "updated_by"    => session("id")
            ]);
            $request->session()->put("pagename", "Kapal");
            $request->session()->flash("message", "Vehicle " . $request->vehicle_id . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/vehicle");
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "vehicle_id"    => "required",
                "vehicle_type"  => "required",
                "vehicle_name"  => "required",
            ]);
            Vehicle::create([
                "vehicle_id"    => $request->vehicle_id,
                "vehicle_type"  => $request->vehicle_type,
                "vehicle_name"  => $request->vehicle_name,
                "created_by"    => session("id")
            ]);
            $request->session()->put("pagename", "Kapal");
            $request->session()->flash("message", "Vehicle " . $request->vehicle_id . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/vehicle");
        } else {
            return redirect("/login");
        }
    }
}

