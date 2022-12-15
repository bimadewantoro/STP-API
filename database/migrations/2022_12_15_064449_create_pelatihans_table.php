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
            $table->foreignId ('admin_id') -> constrained () -> onDelete ('cascade');
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('judul_pelatihan', 500);
            $table->string('deskripsi', 1500);
            $table->string('pembicara');
            $table->integer('kapasitas');
            $table->integer('biaya');
            $table->dateTime('hari');
            $table->dateTime('jam');
            $table->binary('dokumen_pendukung');
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
