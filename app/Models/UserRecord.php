<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'full_name',
        'email',
        'role',
        'password',
    ];

    // Ensure passwords are hashed
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
