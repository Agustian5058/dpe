<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VehicleArrival extends Model
{
    use HasFactory;
    protected $fillable = [
        'arrival_id',
        'arrival_date',
        'arrival_vehicle',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected function arrival_id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),
        );
    }
    protected function arrival_date(): Attribute
    {
        return $this->format('d-m-Y');
    }
    protected function arrival_vehicle()
    {
        return $this->belongsTo('App/Models/Vehicle', 'arrival_vehicle', 'vehicle_id');
    }
    public function transaction_arrival()
    {
        return $this->hasMany('App/Models/Transaction', 'transaction_arrival');
    }
}
