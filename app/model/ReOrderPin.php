<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class ReOrderPin extends Model
{
    protected $table = 'orderulang';
    public $timestamps = false;
    protected $fillable = [
        'tgl',
        'username',
        'paket',
        'jmlbayar',
        'status',
    ];
}
