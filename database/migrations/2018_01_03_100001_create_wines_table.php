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
            $table->string('image')->default(storage_path('app/public/images/wines/default.png'));
            $table->string('thumbnail')->default(storage_path('app/public/images/wines/thumbnails/default.png'));
            $table->unsignedInteger('rating_count');
            $table->float('rating_sum');
            $table->unsignedInteger('temperature');
            $table->unsignedInteger('alcohol');

            $table->unsignedInteger('wine_acidity_id');
            $table->unsignedInteger('wine_body_id');
            $table->unsignedInteger('wine_color_id');
            $table->unsignedInteger('wine_origin_denomination_id');
            $table->unsignedInteger('wine_type_id');
            $table->unsignedInteger('winery_id');

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
