<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Redeem extends Model
{
    protected $fillable = [
        'value', 'doge',
    ];
}
