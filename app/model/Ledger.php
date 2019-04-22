<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledger';
    public $timestamps = false;
    protected $fillable = [
        'notrx', 'tgl', 'username',
        'keterangan', 'ketkom', 'debet',
        'kredit', 'umurbb', 'status',
        'lunas', 'rekap',
    ];
}
