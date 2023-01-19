<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormPendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
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
        Schema::dropIfExists('form_pendaftarans');
        $table->foreign('user_id') -> references ('id') -> onDelete ('cascade') -> onUpdate ('cascade');
    }
}
