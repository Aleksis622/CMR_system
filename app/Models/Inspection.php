<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;
class Inspection extends Model
{
    use HasFactory;
    use Auditable;
    protected $fillable = [
        'inspection_id',
        'case_id',
        'type',
        'requested_by',
        'start_ts',
        'location',
        'checks',
        'assigned_to',
    ];

    protected $casts = [
        'checks' => 'array',
        'start_ts' => 'datetime',
    ];
}
