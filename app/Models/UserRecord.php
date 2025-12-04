<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\Traits\Auditable;
class UserRecord extends Model
{
    protected $table = 'user_records';
    use Auditable;
    protected $fillable = [
        'user_id',
        'name',
        'full_name',
        'email',
        'password',
        'role',
        'active',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
