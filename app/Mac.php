<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mac extends Model
{
    protected $fillable = [ 
        'sap_code',
        'material_desc',
        'plant',
        'mac'
    ];
}
