<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;
class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'case_id',
        'type',
        'title',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];
}
