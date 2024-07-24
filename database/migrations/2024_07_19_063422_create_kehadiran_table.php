<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->bigIncrements('id_kehadiran');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_absensi')->unsigned();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->bigInteger('id_pk')->unsigned();
            $table->integer('jumlah_pk')->unsigned();
            $table->integer('pk_selesai')->unsigned();
            $table->integer('pk_belum')->unsigned();
            $table->string('status', 50)->nullable();
            $table->date('tanggal');
            $table->timestamps();

            // Adding foreign key constraints
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_absensi')->references('id')->on('absensi')->onDelete('cascade');
            $table->foreign('id_pk')->references('id')->on('pk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_absensi']);
            $table->dropForeign(['id_pk']);
        });

        Schema::dropIfExists('kehadiran');
    }
};
