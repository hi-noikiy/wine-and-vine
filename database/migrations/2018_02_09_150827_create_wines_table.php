<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('winnery_id');
            $table->string('name');
            // Example: ['Red', 'White', 'Sparkling', 'Rosé', 'Dessert', 'Port']
            $table->string('type');
            // TODO: investigate if it is necessary to make an enum out of type
            // Example: ['Portuguese Alentejo Red', 'Portuguese Dão Red', 'Portuguese Moscatel']
            $table->string('style');
            $table->text('description');
            $table->date('year');
            $table->float('price');
            $table->unsignedBigInteger('quantity_in_stock');
            $table->unsignedInteger('rating_count');
            $table->float('rating_sum');
            $table->string('region');
            $table->string('country');
            $table->string('food_pairing');
            $table->timestamps();

            // Add a grapes table to make a pivot between
            // grapes - wine_grape - wines
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wines');
    }
}
