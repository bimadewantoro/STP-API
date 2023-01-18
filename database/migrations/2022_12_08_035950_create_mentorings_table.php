<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentoringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('judul_mentoring', 250);
            $table->dateTime('tanggal_mulai');
            $table->integer('durasi');
            $table->string('judul_tugas', 500);
            $table->string('deskripsi', 1500);
            $table->binary('image_path_banner');
            $table->dateTime('deadline_pengumpulan');
            $table->integer('status_pengumpulan');
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
        Schema::dropIfExists('mentorings');
    }
}
