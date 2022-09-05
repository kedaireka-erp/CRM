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
        Schema::create('kontak_ncr', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kontak_id")->constrained("kontaks")->onUpdate("cascade");
            $table->foreignId("ncr_id")->constrained("ncrs")->onUpdate("cascade");
            $table->boolean("validated")->nullable();
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
        Schema::dropIfExists('kontak_ncr');
    }
};
