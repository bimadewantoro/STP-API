<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentoring_pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('mentoring_id') -> constrained () -> onDelete ('cascade');
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->integer('nilai_penugasan');
            $table->string('lampiran_path', 2500);
            $table->dateTime('tanggal_upload');
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
        Schema::dropIfExists('mentoring_pesertas');
    }
}
