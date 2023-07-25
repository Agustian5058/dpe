<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    public function index(Request $request): View
    {
        if ($request->session()->has("username")) {
            return redirect("/home");
        } else {
            $login = array_key_exists("username", $_POST);
            if ($login) {
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
                            $request->session()->put("username", $userData->username);
                            $request->session()->put("name", $userData->name);
                            $request->session()->put("role", $userData->role);
                            return redirect("/home");
                        }
                    } else {
                        $error = "User Does not Exist";
                    }
                }
                if ($error) {
                    $request->session()->flash("username", $username);
                    $request->session()->flash("error", $error);
                    return  view("login");
                }
            } else {
                return view("login");
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect("/login");
    }

    public function forgotPassword(Request $request): View
    {
        $request->session()->flush();
        return view("login/forgot_password");
    }
}
