<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        // $value = $request->session()->get('key');
        $user = "";
        return view('login', compact('user'));
    }
}
