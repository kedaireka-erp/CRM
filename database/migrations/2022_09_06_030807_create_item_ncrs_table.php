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
        Schema::create('item_ncrs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_item');
            $table->string('nama_item');
            $table->string('tipe_item')->nullable();
            $table->string('warna')->nullable();
            $table->string('bukaan')->nullable();
            $table->integer('lebar')->nullable();
            $table->integer('tinggi')->nullable();
            $table->text('alasan')->nullable();
            $table->boolean('charge')->nullable();
            $table->boolean('return_barang')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId("ncr_id")->constrained("ncrs")->onUpdate("cascade");
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
        Schema::dropIfExists('item_ncrs');
    }
};
