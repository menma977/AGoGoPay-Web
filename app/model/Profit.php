<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'joins', 'roi', 'max', 'sponsor', 'pairing', 'royalty', 'day'
    ];
}
