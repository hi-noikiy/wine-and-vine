<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodPairWineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_pair_wine', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('food_pair_id');
            $table->unsignedInteger('wine_id');

            $table->unique(['food_pair_id', 'wine_id']);

            $table->foreign('food_pair_id')
                ->references('id')
                ->on('food_pairs')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('wine_id')
                ->references('id')
                ->on('wines')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schemma::dropIfExists('food_pair_wine');
    }
}
