<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $table = 'serialproduk';
    public $timestamps = false;
    protected $fillable = [
        'tglpakai',
        'pin',
        'stokis',
        'username',
        'status',
    ];
}
