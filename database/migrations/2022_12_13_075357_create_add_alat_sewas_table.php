<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddAlatSewasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_alat_sewas', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('nama_alat');
            $table->string('no_seri');
            $table->string('merk');
            $table->integer('tahun_pembelian');
            $table->string('pemilik');
            $table->string('alamat');
            $table->integer('biaya_harian')->nullable();
            $table->integer('biaya_mingguan')->nullable();
            $table->integer('biaya_bulanan')->nullable();
            $table->integer('biaya_tahunan')->nullable();
            $table->string('file_path')->nullable();
            $table->string('image_path_banner')->nullable();
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
        Schema::dropIfExists('add_alat_sewas');
    }
}