<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ncrs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->string('nama_proyek')->nullable();
            $table->string('nomor_ncr');
            $table->string('nomor_fppp');
            $table->dateTime('tanggal_ncr');
            $table->string('pelapor');
            $table->string('nomor_memo')->nullable();
            $table->string('tanggal_memo')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->dateTime('deadline_pengambilan')->nullable();
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
        Schema::dropIfExists('ncrs');
    }
};
