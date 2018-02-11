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
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username')->unique();
            $table->text('description')->nullable();
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
            $table->softDeletes();
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
