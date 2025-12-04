<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;
class Vehicle extends Model
{   use Auditable;
    protected $fillable = [
        'vehicle_id', 'plate_no', 'country', 'make', 'model', 'vin',
    ];
}
