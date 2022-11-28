<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProposalKonten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_kontens', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('proposal_id') -> constrained () -> onDelete ('cascade');
            $table->string('konten_judul');
            $table->string('konten_subjudul');
            $table->longText('konten_isi');
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
        //
    }
}
