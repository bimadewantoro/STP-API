<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('proposal_judul', 150);
            $table->enum('proposal_kategori', ['Tech', 'Food']);
            $table->longText('proposal_bab1')->nullable();
            $table->longText('proposal_bab2')->nullable();
            $table->longText('proposal_bab3')->nullable();
            $table->longText('proposal_bab4')->nullable();
            $table->longText('proposal_bab5')->nullable();
            $table->longText('proposal_bab6')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}
