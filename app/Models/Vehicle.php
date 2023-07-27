<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',
        'vehicle_type',
        'vehicle_name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected function vehicle_id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
            set: fn (string $value) => strtoupper($value),);
    }
    protected function vehicle_type(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => ucfirst($value),
        );
    }
    protected function vehicle_name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => ucfirst($value),
        );
    }
    public function arrival_vehicle()
    {
        return $this->hasMany('App/Models/VehicleArrival', 'arrival_vehicle');
    }
}
