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
            $table->date('tanggal_ncr');
            $table->string('pelapor');
            $table->text('deskripsi')->nullable();
            $table->text('analisa')->nullable();
            $table->string('jenis_ketidaksesuaian')->nullable();
            $table->text('solusi')->nullable();
            $table->text('bukti_kecacatan');
            $table->string('nomor_memo')->nullable();
            $table->date('tanggal_memo')->nullable();
            $table->string('alamat_pengiriman')->nullable();
            $table->date('deadline_pengambilan')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamp('delete_memo')->nullable();
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
