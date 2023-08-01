<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\VehicleArrival;
use App\Models\Vehicle;

class VehicleArrivalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kedatangan Kapal");
            $dataArrivals = VehicleArrival::join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->orderBy('arrival_id')->get(["vehicle_arrivals.*", "vehicles.vehicle_name"]);
            $dataVehicles = Vehicle::latest()->paginate(10);
            return view("arrival", compact("dataArrivals", "dataVehicles"));
        } else {
            return redirect("/login");
        }
    }
     public function edit(Request $request, $arrival_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kedatangan Kapal");
            $dataArrivals = VehicleArrival::where("arrival_id", $arrival_id)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"])->firstOrFail();
            $dataVehicles = Vehicle::latest()->paginate(10);
            return view("arrival_update", compact("dataArrival", "dataVehicles"));
        } else {
            return redirect("/login");
        }
    }

    public function show(Request $request, $arrival_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kedatangan Kapal");
            $dataArrivals = VehicleArrival::where("arrival_id", $arrival_id)->join("vehicles", "vehicles.vehicle_id", "=", "vehicle_arrivals.arrival_vehicle")->get(["vehicle_arrivals.*", "vehicles.vehicle_name"])->firstOrFail();
            $dataVehicles = Vehicle::latest()->paginate(10);
            return view("arrival", compact("dataArrivals", "dataVehicles"));
        } else {
            return redirect("/login");
        }
    }

    public function update(Request $request, $arrival_id)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "arrival_id"        => "required",
                "arrival_date"      => "required",
                "arrival_vehicle"   => "required"
            ]);
            $dataArrival = VehicleArrival::where("arrival_id", $request->arrival_id)->firstOrFail();
            $dataArrival->update([
                "arrival_date"      => $request->arrival_date,
                "arrival_vehicle"   => $request->arrival_vehicle,
                "updated_by"        => session("id")
            ]);
            $request->session()->put("pagename", "Kedatangan Kapal");
            $request->session()->flash("message", "Kedatangan Kendaraan " . $request->arrival_id . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/arrival");
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "arrival_date"      => "required",
                "arrival_vehicle"   => "required"
            ]);
            $arrival_id = $request->arrival_date . "-" . $request->arrival_vehicle;
            VehicleArrival::create([
                "arrival_id"        => $arrival_id,
                "arrival_date"      => $request->arrival_date,
                "arrival_vehicle"   => $request->arrival_vehicle,
                "created_by"        => session("id")
            ]);
            $request->session()->put("pagename", "Kedatangan Kapal");
            $request->session()->flash("message", "Kedatangan Kendaraan " . $arrival_id . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/arrival");
        } else {
            return redirect("/login");
        }
    }

    public function destroy(Request $request, $arrival_id)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Kedatangan Kapal");
            $dataArrivals = VehicleArrival::where("arrival_id", $arrival_id)->firstOrFail();
            $request->session()->flash("message", "Kedatangan " . $request->customer_id . " " . $request->customer_name . " Telah Dihapus");
            $request->session()->flash("status", "success");
            $dataArrivals->delete();
            return redirect("/arrival");
        } else {
            return redirect("/login");
        }
    }

}


