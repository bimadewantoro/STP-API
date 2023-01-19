<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->binary('profile_image', 4294967295);
            $table->integer('profile_number');
            $table->integer('profile_age');
            $table->string('profile_address_province', 100);
            $table->string('profile_address_city', 100);
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
        Schema::dropIfExists('user_details');
        $table->foreign('user_id') -> references ('id') -> onDelete ('cascade') -> onUpdate ('cascade');
    }
}
