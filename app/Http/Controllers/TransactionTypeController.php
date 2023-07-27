<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Jenis Transaksi");
            $dataTransactionTypes = TransactionType::latest()->paginate(15);
            return view("transaction_type", compact("dataTransactionTypes"));
        } else {
            return view("login");
        }
    }
    
    public function edit(Request $request, $transaction_name)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Jenis Transaksi");
            $dataTransactionType = TransactionType::where("transaction_name", $transaction_name)->firstOrFail();
            return view("transaction_type_update", compact("dataTransactionType"));
        } else {
            return view("login");
        }
    }

    public function show(Request $request, $transaction_name)
    {
        if ($request->session()->has("username")) {
            $request->session()->put("pagename", "Jenis Transaksi");
            $dataTransactionTypes = TransactionType::where("transaction_name", $transaction_name)->firstOrFail();
            return view("transaction_type", compact("dataTransactionTypes"));
        } else {
            return view("login");
        }
    }

    public function update(Request $request, $transaction_name)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "transaction_name"          => "required",
                "transaction_debit_credit"  => "required",
                "transaction_initial"       => ""
            ]);
            $dataTransactionType = TransactionType::where("transaction_name", $request->transaction_name)->firstOrFail();
            $dataTransactionType->update([
                "transaction_debit_credit"  => $request->transaction_debit_credit,
                "transaction_initial"       => $request->transaction_initial,
                "updated_by"                => session("id")
            ]);
            $request->session()->put("pagename", "Jenis Transaksi");
            $request->session()->flash("message", "TransactionType " . $request->transaction_name . " Telah Diubah");
            $request->session()->flash("status", "success");
            return redirect("/transaction_type");
        } else {
            return view("login");
        }
    }

    public function store(Request $request)
    {
        if ($request->session()->has("username")) {
            $this->validate($request, [
                "transaction_name"          => "required",
                "transaction_debit_credit"  => "required",
                "transaction_initial"       => ""
            ]);
            TransactionType::create([
                "transaction_name"          => $request->transaction_name,
                "transaction_debit_credit"  => $request->transaction_debit_credit,
                "transaction_initial"       => $request->transaction_initial,
                "created_by"                => session("id")
            ]);
            $request->session()->put("pagename", "Jenis Transaksi");
            $request->session()->flash("message", "TransactionType " . $request->transaction_name . " Telah Ditambahkan");
            $request->session()->flash("status", "success");
            return redirect("/transaction_type");
        } else {
            return view("login");
        }
    }
}


