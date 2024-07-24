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
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('id_absensi');
            $table->string('judul_absensi', 255);
            $table->string('deskripsi_absensi', 255);
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->time('batas_jam_masuk');
            $table->time('batas_jam_pulang');
            $table->string('code_absensi', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensi');
    }
};
