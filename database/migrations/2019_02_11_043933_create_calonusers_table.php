<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalonusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calonusers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('notrx');
            $table->text('tgl');
            $table->text('tglvalidasi');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('sponsor');
            $table->string('upline');
            $table->string('posisi');
            $table->string('nohp');
            $table->string('email')->unique();
            $table->text('nominaltransfer');
            $table->text('paket');
            $table->text('kontrak');
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
        Schema::dropIfExists('calonusers');
    }
}
