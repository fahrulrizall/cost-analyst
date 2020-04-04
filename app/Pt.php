<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pt extends Model
{
    protected $fillable = [ 
        'pt_name',
        'sap_code',
        'validate',
        'material_desc',
        'plant',
        'price_lbs',
        'processing_fee',
        'category',
        'lbs',
        'loin'
    ];

    // public function getRouteKeyName()
    // {
    //     return 'pt_name';
    // }
}
