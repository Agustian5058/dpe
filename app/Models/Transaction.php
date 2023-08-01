<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'transaction_date',
        'transaction_container_number',
        'goods_type',
        'feet',
        'qty',
        'price',
        'note',
        'previous_amount',
        'current_amount',
        'transaction_debit_credit',
        'transaction_transaction_type',
        'transaction_vehicle_arrival',
        'transaction_customer',
        'created_by',
        'updated_by',
        'deleted_by'

    ];
    protected function transaction_transaction_type()
    {
        return $this->belongsTo('App/Models/TransactionType', 'transaction_transaction_type', 'transaction_name');
    }
    protected function transaction_vehicle_arrival()
    {
        return $this->belongsTo('App/Models/VehicleArrival', 'transaction_vehicle_arrival', 'arrival_id');
    }
    protected function transaction_customer()
    {
        return $this->belongsTo('App/Models/Customer', 'transaction_customer', 'customer_id');
    }
}
