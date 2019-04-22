<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('username', 30);
            $table->text('password');
            $table->string('password_mirror', 15);
            $table->text('wallet')->nullable();
            $table->string('typeakun', 100)->nullable();
            $table->string('tiket', 10)->nullable();
            $table->string('notrx', 100)->nullable();
            $table->string('ip', 15)->nullable();
            $table->string('bank', 150)->nullable();
            $table->string('norek', 150)->nullable();
            $table->string('namarek', 100)->nullable();
            $table->string('cabang', 100)->nullable();
            $table->string('phone', 150)->nullable();
            $table->integer('mb')->nullable();
            $table->string('money', 100)->nullable();
            $table->string('sponsor', 30)->nullable();
            $table->string('pendaftaran', 100)->nullable();
            $table->string('manager', 100)->nullable();
            $table->string('biting', 100)->nullable();
            $table->string('avatar', 500)->nullable();
            $table->string('country', 150)->nullable();
            $table->date('join')->nullable();
            $table->date('joindateupg')->nullable();
            $table->string('lasttiplog', 150)->nullable();
            $table->string('alamat', 200)->nullable();
            $table->string('ahliwaris', 100)->nullable();
            $table->string('hubungan', 100)->nullable();
            $table->string('kota', 200)->nullable();
            $table->string('provinsi', 200)->nullable();
            $table->string('kelamin', 10)->nullable();
            $table->string('kodepos', 10)->nullable();
            $table->string('userkiri', 100)->nullable();
            $table->string('userkanan', 100)->nullable();
            $table->integer('kiri')->nullable();
            $table->string('trxkiri', 100)->nullable();
            $table->integer('kanan')->nullable();
            $table->string('trxkanan', 100)->nullable();
            $table->time('jamkiri')->nullable();
            $table->time('jamkanan')->nullable();
            $table->integer('jmlkiri')->nullable();
            $table->integer('jmlkanan')->nullable();
            $table->string('tercapai1kiri', 100)->nullable();
            $table->string('tercapai1kanan', 100)->nullable();
            $table->string('ra1', 100)->nullable();
            $table->string('ra2', 100)->nullable();
            $table->string('ra3', 100)->nullable();
            $table->string('ra4', 100)->nullable();
            $table->string('ra5', 100)->nullable();
            $table->integer('rjmlkiri')->nullable();
            $table->integer('rjmlkanan')->nullable();
            $table->integer('mkiri')->nullable();
            $table->integer('mkanan')->nullable();
            $table->string('rewardkiri', 100)->nullable();
            $table->string('rewardkanan', 100)->nullable();
            $table->string('omankiri', 100)->nullable();
            $table->string('omarkanan', 100)->nullable();
            $table->string('posisi', 100)->nullable();
            $table->string('posisipon', 100)->nullable();
            $table->string('upline', 100)->nullable();
            $table->string('totkiri', 100)->nullable();
            $table->string('totkanan', 100)->nullable();
            $table->string('suspend', 2)->nullable();
            $table->string('sbonus', 100)->nullable();
            $table->string('editprofil', 100)->nullable();
            $table->string('status', 10)->nullable();
            $table->string('statkualifikasi', 100)->nullable();
            $table->string('statusall', 100)->nullable();
            $table->integer('statjml')->nullable();
            $table->string('statomzall', 100)->nullable();
            $table->string('statomzspon', 100)->nullable();
            $table->string('free', 100)->nullable();
            $table->string('wdprof', 100)->nullable();
            $table->text('serial')->nullable();
            $table->integer('aktifakun')->nullable();
            $table->string('umurakun', 100)->nullable();
            $table->integer('limittransfer')->nullable();
            $table->string('aktif', 10)->nullable();
            $table->string('paket', 100)->nullable();
            $table->string('statepos', 100)->nullable();
            $table->integer('statuang')->nullable();
            $table->string('statuang1', 100)->nullable();
            $table->string('stokis', 100)->nullable();
            $table->integer('tsponsor')->nullable();
            $table->integer('tbonus')->nullable();
            $table->string('treward',100)->nullable();
            $table->string('jmlnaik',100)->nullable();
            $table->string('upgrade',100)->nullable();
            $table->string('statusupgrade',100)->nullable();
            $table->string('statistik',100)->nullable();
            $table->string('statusmem',100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
