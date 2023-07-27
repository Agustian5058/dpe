<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_name',
        'transaction_debit_credit',
        'transaction_initial',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected function transaction_name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => ucwords($value),
        );
    }
    protected function transaction_debit_credit(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    protected function transaction_initial(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    public function transaction_transaction_type()
    {
        return $this->hasMany('App/Models/Transaction', 'transaction_transaction_type');
    }
}
