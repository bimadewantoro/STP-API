<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianJurisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_juris', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('proposal_id') -> constrained () -> onDelete ('cascade');
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->integer('penerapan_di_masyarakat');
            $table->integer('manfaat');
            $table->integer('keberlangsungan');
            $table->integer('presentasi_penyajian_produk');
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
        Schema::dropIfExists('penilaian_juris');
    }
}
