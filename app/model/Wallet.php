<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'wallet', 'bank', 'name', 'status',
    ];
}
