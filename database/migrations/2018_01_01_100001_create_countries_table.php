<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cca2');
            $table->string('cca3');
            $table->string('emoji')->nullable();
            $table->string('address_format')->nullable();
            $table->string('continent')->nullable();
            $table->boolean('eu_member')->nullable();
            $table->string('svg_path')->nullable();
            $table->timestamps();

            $table->unique(['name', 'cca2', 'cca3']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
