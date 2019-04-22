<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Calonuser extends Model
{
    protected $table = 'calonuser';

    protected $fillable = [
        'notrx', 'tgl', 'tglvalidasi',
        'username', 'password', 'sponsor',
        'upline', 'posisi', 'nohp',
        'email', 'nominaltransfer', 'paket',
        'kontrak',
    ];
}
