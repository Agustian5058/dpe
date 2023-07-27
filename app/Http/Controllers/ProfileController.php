<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, $username)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Profil");
            $profile = User::where("username", $username)->firstOrFail();
            return view("profile", compact("profile"));
        } else {
            return view("login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $username = $request->username;
            $password = $request->password;
            $email = $request->email;
            $name = $request->name;
            $role = $request->role;
            $phone = $request->phone;
            
            $request->session()->put("pagename", "Profil");
            $profile = User::where("username", $username)->firstOrFail();
            return view("profile", compact("profile"));
        } else {
            return view("login");
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
            return view("login");
        }
    }
}
