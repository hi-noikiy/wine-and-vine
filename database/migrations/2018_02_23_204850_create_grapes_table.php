<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grapes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_description');
            $table->text('description');
            $table->unsignedInteger('acidity_id');
            $table->unsignedInteger('body_id');
            $table->unsignedInteger('color_id');
            $table->timestamps();

            $table->unique(['name']);

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
        Schema::dropIfExists('grapes');
    }
}
