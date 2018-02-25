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
            $table->string('avatar')->default(storage_path('app/public/images/user/default.png'));
            $table->unsignedBigInteger('rating_count')->default(0);
            $table->boolean('newsletter')->default(true);
            $table->boolean('email_offers')->default(true);
            $table->unsignedInteger('rank')->default(0);

            $table->unsignedInteger('country_id');
            $table->unsignedInteger('shipping_address_id')->nullable();
            $table->unsignedInteger('rating_visibility_id')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['rating_visibility_id', 'country_id']);

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade');

            $table->foreign('rating_visibility_id')
                ->references('id')
                ->on('rating_visibilities')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
