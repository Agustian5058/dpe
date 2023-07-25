<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        $sales = Sales::latest()->paginate(5);
        return view('sales.index', compact('sales'));
    }
}
