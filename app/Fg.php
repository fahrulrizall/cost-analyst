<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fg extends Model
{
    protected $fillable = [ 
                            'sap_code',
                            'material_desc',
                            'plant',
                            'price_lbs',
                            'lbs',
                            'std_price',
                            'processing_fee',
                            'category'
                        ];

}
