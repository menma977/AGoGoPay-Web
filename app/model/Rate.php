<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'rate', 'jml_rate', 'status',
    ];
}
