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
            $table->string('name');
            $table->year('year');
            $table->float('price');
            $table->text('description');
            $table->unsignedBigInteger('quantity_in_stock');
            $table->unsignedInteger('rating_count');
            $table->float('rating_sum');
            $table->unsignedInteger('temperature');
            $table->unsignedInteger('alcohol');

            $table->unsignedInteger('acidity_id');
            $table->unsignedInteger('body_id');
            $table->unsignedInteger('color_id');
            $table->string('food_pairing');
            $table->unsignedInteger('winery_id');
            $table->unsignedInteger('wine_type_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('winery_id')
                ->references('id')
                ->on('wineries');

            $table->foreign('wine_type_id')
                ->references('id')
                ->on('wine_types');

            $table->foreign('acidity_id')
                ->references('id')
                ->on('acidities');

            $table->foreign('body_id')
                ->references('id')
                ->on('bodies');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors');
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
