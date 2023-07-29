<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_sales',
        'customer_phone',
        'customer_postal_code',
        'customer_fax',
        'customer_address',
        'customer_province',
        'customer_city',
        'amount',
        'created_by',
        'updated_by',
        'deleted_by'

    ];
    protected function customer_id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }
    protected function customer_name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => ucfirst($value),
        );
    }
    protected function customer_sales()
    {
        return $this->belongsTo('App/Models/Sales', 'customer_sales', 'sales_id');
    }
    public function transaction_customer()
    {
        return $this->hasMany('App/Models/Transaction', 'trasanction_customer');
    }
}
