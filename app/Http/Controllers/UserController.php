<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "User");
            $dataUsers = User::latest()->paginate(10);
            return view("user", compact("dataUsers"));
        } else {
            return redirect("/login");
        }
    }
    
    public function edit(Request $request, $username)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "User");
            $dataUser = User::where("username", $username)->firstOrFail();
            return view("user_update", compact("dataUser"));
        } else {
            return redirect("/login");
        }
    }

    public function show(Request $request, $username)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "User");
            $dataUsers = User::where("username", $username)->firstOrFail();
            return view("user", compact("dataUsers"));
        } else {
            return redirect("/login");
        }
    }

    public function update(Request $request, $username)
    {
        if ($request->session()->has("username")) {
            if ($request->has("password")){
                $this->validate($request, [
                    "username"  => "required",
                    "name"      => "required",
                    "role"      => "required",
                    "password"  => "",
                    "email"     => "",
                    "phone"     => "",
                ]);
                $dataUser = User::where("username", $request->username)->firstOrFail();
                $dataUser->update([
                    "name"          => $request->name,
                    "role"          => $request->role,
                    "email"         => $request->email,
                    "phone"         => $request->phone,
                    "updated_by"    => session("id")
                ]);
                $request->session()->put("pagename", "User");
                $request->session()->flash("message", "User " . $request->username . " Telah Diubah");
                $request->session()->flash("status", "success");
            } else {
                $dataUser = User::where("username", $request->username)->firstOrFail();
                $dataUser->update([
                    "password"      => md5($request->username),
                    "updated_by"    => session("id")
                ]);
                $request->session()->put("pagename", "User");
                $request->session()->flash("message", "Password User " . $request->username . " Telah Direset");
                $request->session()->flash("status", "success");
            }
            return redirect("/user");
        } else {
            return redirect("/login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "username"  => "required",
                "name"      => "required",
                "role"      => "required"
            ]);
            User::create([
                "username"      => $request->username,
                "password"      => md5($request->username),
                "name"          => $request->name,
                "role"          => $request->role,
                "email"         => $request->email,
                "phone"         => $request->phone,
                "created_by"    => session("id")
            ]);
            $request->session()->put("pagename", "User");
            $request->session()->flash("message", "User " . $request->username . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/user");
        } else {
            return redirect("/login");
        }
    }
}
