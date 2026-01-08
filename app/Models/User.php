<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{  
    public function inspections()
{
    return $this->hasMany(Inspection::class, 'assigned_to', 'external_id');
}
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'external_id',
        'full_name',
        'role',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'active' => 'boolean',
    ];
}


