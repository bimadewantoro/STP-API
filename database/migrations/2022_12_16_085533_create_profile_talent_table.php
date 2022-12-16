<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_talent', function (Blueprint $table) {
            $table->id();
            $table->foreignId ('user_id') -> constrained () -> onDelete ('cascade');
            $table->string('profile_image');
            $table->string('profile_number');
            $table->integer('profile_age');
            $table->string('profile_address_province');
            $table->string('profile_address_city');
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
        Schema::dropIfExists('profile_talent');
    }
}
