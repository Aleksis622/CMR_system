<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'party_id',
        'type',
        'name',
        'reg_code',
        'vat',
        'country',
        'email',
        'phone',
    ];
}
