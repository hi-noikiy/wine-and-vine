<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWineriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wineries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('slug')->unique();

            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('region_id');

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'phone_number', 'mobile_number']);

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');

            $table->foreign('owner_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wineries');
    }
}
