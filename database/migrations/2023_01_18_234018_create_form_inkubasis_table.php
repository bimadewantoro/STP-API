<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormInkubasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_inkubasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('profil_bisnis');
            $table->string('model_bisnis');
            $table->longtext('deskripsi');
            $table->string('strategi_marketing');
            $table->string('profil_pemilik');
            $table->integer('jumlah_pegawai');
            $table->string('projeksi_keuangan');
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
        Schema::dropIfExists('form_inkubasis');
    }
}
