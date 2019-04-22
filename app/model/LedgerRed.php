<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class LedgerRed extends Model
{
    protected $table = 'ledgerred';
    public $timestamps = false;
    protected $fillable = [
        'notrx', 'tgl', 'username',
        'keterangan', 'ketkom', 'debet',
        'kredit', 'umurbb', 'status',
        'lunas', 'rekap',
    ];
}
