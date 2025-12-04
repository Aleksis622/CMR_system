<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;
class CaseRecord extends Model
{
    protected $table = 'cases';
   use Auditable;

    protected $fillable = [
        'case_id',
        'external_ref',
        'status',
        'priority',
        'arrival_ts',
        'checkpoint_id',
        'origin_country',
        'destination_country',
        'risk_flags',
        'declarant_id',
        'consignee_id',
        'vehicle_id',
       ' hs_code', 
        'country', 
        'currency', 
        'amount', 
        'date'
    ];

    protected $casts = [
        'risk_flags' => 'array',
        'arrival_ts' => 'datetime',
    ];
}
