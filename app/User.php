<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'nama', 'namarek', 'password', 'password_mirror', 'wallet','typeakun', 'tiket', 'notrx',
        'ip', 'email', 'bank','norek', 'namarek', 'cabang',
        'phone', 'mb', 'money','sponsor', 'pendaftaran', 'manager',
        'biting', 'avatar', 'country','join', 'joindateupg', 'lasttiplog',
        'alamat', 'ahliwaris', 'hubungan','kota', 'provinsi', 'kelamin',
        'kodepos', 'userkiri', 'userkanan','kiri', 'trxkiri', 'kanan',
        'trxkanan', 'jamkiri', 'jamkanan','jmlkiri', 'jmlkanan', 'tercapai1kiri',
        'tercapai1kanan', 'ra1', 'ra2','ra3', 'ra4', 'ra5',
        'rjmlkiri', 'rjmlkanan', 'mkiri','mkanan', 'rewardkiri', 'rewardkanan',
        'omankiri', 'omarkanan', 'posisi','posisipon', 'upline', 'totkiri',
        'totkanan', 'suspend', 'sbonus','editprofil', 'status', 'statkualifikasi',
        'statusall', 'statjml', 'statomzall','statomzspon', 'free', 'wdprof',
        'serial', 'aktifakun', 'umurakun','limittransfer', 'aktif', 'paket',
        'statepos', 'statuang', 'statuang1','stokis', 'tsponsor', 'tbonus',
        'treward', 'jmlnaik', 'upgrade','statusupgrade', 'statistik', 'statusmem',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
