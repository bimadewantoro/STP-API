<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoWorkSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_work_spaces', function (Blueprint $table) {
            $table->id();
            $table->string('nama_workspace');
            $table->string('alamat');
            $table->string('kapasitas');
            $table->string('nomor_pengurus');
            $table->string('biaya_harian');
            $table->string('biaya_mingguan');
            $table->string('biaya_bulanan');
            $table->string('biaya_tahunan');
            $table->string('fasilitas');
            $table->time('jam_operasional_buka')->nullable();
            $table->time('jam_operasional_tutup')->nullable();
            $table->enum('hari_operasional_buka', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->enum('hari_operasional_tutup', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
            $table->string('dokumen_cowork_path')->nullable();
            $table->string('image_cowork_path')->nullable();
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
        Schema::dropIfExists('co_work_spaces');
    }
}
