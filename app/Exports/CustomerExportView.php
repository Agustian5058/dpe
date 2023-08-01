<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExportView implements FromView
{
    public function view(): View
    {
        return view('reportcustomer_table', ['dataCustomers' => Customer::all()]);
    }
}
