<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ListProfit extends Model
{
    protected $table = 'listpaket';
    public $timestamps = false;
    protected $fillable = [
        'username', 'terwd', 'withdraw'
    ];
}
