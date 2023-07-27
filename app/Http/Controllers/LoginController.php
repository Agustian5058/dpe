<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            return redirect("/dashboard");
        } else {
            return view("login");
        }
    }

    public function store(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if ($username == "" or $password == "") {
            $error = "Username or Password cannot be Null";
        }
        if (empty($error)) {
            $userData = User::where("username", $username)->firstOrFail();
            if ($userData) {
                if ($userData->password != md5($password)) {
                    $error = "Wrong Password";
                } else {
                    $request->session()->put("id", $userData->id);
                    $request->session()->put("username", $userData->username);
                    $request->session()->put("name", $userData->name);
                    $request->session()->put("role", $userData->role);
                    return redirect("/dashboard");
                }
            } else {
                $error = "User Does not Exist";
            }
        }
        if ($error) {
            $request->session()->flash("username", $username);
            $request->session()->flash("error", $error);
            return view("login");
        }
    }
}
