<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('judul_pelatihan');
            $table->string('deskripsi');
            $table->string('pembicara');
            $table->string('kapasitas');
            $table->string('biaya');
            $table->date('hari')->nullable();
            $table->time('jam')->nullable();
            $table->string('dokumen_pelatihan_path')->nullable();
            $table->string('gambar_pelatihan_path')->nullable();
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
        Schema::dropIfExists('pelatihans');
    }
}
