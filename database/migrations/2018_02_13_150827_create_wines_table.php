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
            $table->unsignedInteger('winery_id');
            $table->string('name');
            // Example: ['Red', 'White', 'Sparkling', 'Rosé', 'Dessert', 'Port']
            $table->string('type');
            $table->text('description');
            $table->year('year');
            $table->float('price');
            $table->unsignedBigInteger('quantity_in_stock');
            $table->unsignedInteger('rating_count');
            $table->float('rating_sum');
            $table->string('region');
            $table->string('country');
            $table->string('food_pairing');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('winery_id')
                ->references('id')
                ->on('wineries');
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
