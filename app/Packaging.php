<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $fillable = ['month','plant','lab','ofc','expenses','packagings','other'];
}
