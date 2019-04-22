<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class WithdrawBonus extends Model
{
    protected $table = 'wdbon';
    public $timestamps = false;
    protected $fillable = [
        'notrx', 'tgl', 'tglwd',
        'tglbayar', 'tglvalidasi', 'ketkom',
        'username', 'nama', 'bank',
        'norek', 'saldo', 'admin',
        'ewalet', 'nilaicoin', 'transfer',
        'transfer10', 'xlm', 'statuswd',
        'leader', 'status', 'anyar',
        'statleader', 'hashkirim', 'keterangan',
    ];
}
