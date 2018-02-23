<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrapeWineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grape_wine', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('grape_id');
            $table->unsignedInteger('wine_id');
            $table->timestamps();

            $table->index(['grape_id', 'wine_id']);

            $table->foreign('grape_id')
                ->references('id')
                ->on('grapes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('wine_id')
                ->references('id')
                ->on('wines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grape_wine');
    }
}
