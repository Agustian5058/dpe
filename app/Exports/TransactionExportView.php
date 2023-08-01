<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransactionExportView implements FromView
{
    public function view(): View
    {
        return view('reporttransaction_table', ['transactions' => Transaction::all()]);
    }
}
