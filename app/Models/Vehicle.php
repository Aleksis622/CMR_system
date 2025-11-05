<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle_id', 'plate_no', 'country', 'make', 'model', 'vin',
    ];
}
