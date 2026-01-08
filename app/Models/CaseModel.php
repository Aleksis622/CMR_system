<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;

class CaseModel extends Model
{   use Auditable;
    protected $table = 'cases';

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
    ];

    protected $casts = [
        'risk_flags' => 'array',
        'arrival_ts' => 'datetime',
    ];
}


    //protected static function booted()
   // {
        //static::updated(function ($case) {

          //  $webhook = new WebhookController();
           // $webhook->send([
            //    'case_id' => $case->id,
            //    'status'  => $case->status,
        //    ], 'https://receiver.example.com/webhook');
      //  });

      //  static::created(function ($case) {

        //    $webhook = new WebhookController();
        //    $webhook->send([
        //        'case_id' => $case->id,
        //        'status'  => $case->status,
     //       ], 'https://receiver.example.com/webhook');
    //    });
//    }

