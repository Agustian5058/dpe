<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VehicleArrival extends Model
{
    use HasFactory;
    protected function arrival_id(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    protected function arrival_date(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value),
        );
    }
    protected function arrival_vehicle()
    {
        return $this->belongsTo('App/Models/Vehicle', 'arrival_vehicle', 'vehicle_id');
    }
    public function trasaction_arrival()
    {
        return $this->hasMany('App/Models/Transaction', 'trasaction_arrival');
    }
}
