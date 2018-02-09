<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('wine_id');                 // used for wishlist purposes
            $table->string('firstname', 25);
            $table->string('lastname', 25);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('description')->nullable();
            $table->string('country');
            // TODO: Add a default path for the user avatar
            $table->string('avatar')->default('');
            $table->unsignedBigInteger('rating_count')->default(0);
            $table->enum('rating_visibility', ['private', 'friends', 'public'])->default('public');
            $table->boolean('newsletter')->default(true);
            $table->boolean('email_offers')->default(true);
            $table->unsignedInteger('rank')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
