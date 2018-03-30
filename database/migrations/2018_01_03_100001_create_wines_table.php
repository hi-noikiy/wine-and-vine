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
            $table->string('short_description');
            $table->text('description');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('quantity_in_stock');
            $table->unsignedInteger('temperature');
            $table->unsignedInteger('alcohol');
            $table->unsignedInteger('rank')->default(0);

            $table->unsignedInteger('wine_acidity_id');
            $table->unsignedInteger('wine_body_id');
            $table->unsignedInteger('wine_color_id');
            $table->unsignedInteger('wine_origin_denomination_id');
            $table->unsignedInteger('wine_type_id');
            $table->unsignedInteger('winery_id');
            $table->unsignedInteger('currency_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('winery_id')
                ->references('id')
                ->on('wineries');

            $table->foreign('wine_acidity_id')
                ->references('id')
                ->on('wine_acidities');

            $table->foreign('wine_body_id')
                ->references('id')
                ->on('wine_bodies');

            $table->foreign('wine_color_id')
                ->references('id')
                ->on('wine_colors');

            $table->foreign('wine_origin_denomination_id')
                ->references('id')
                ->on('wine_origin_denominations');

            $table->foreign('wine_type_id')
                ->references('id')
                ->on('wine_types');

            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies');
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
