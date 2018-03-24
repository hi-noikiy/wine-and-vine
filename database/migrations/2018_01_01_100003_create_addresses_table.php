<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('addressable_id');  // !! very important for the polymorphic relation
            $table->string('addressable_type');         // !! very important for the polymorphic relation
            $table->string('type');
            $table->string('street_name');
            $table->string('postcode');
            $table->string('city');
            $table->boolean('is_primary');
            $table->timestamps();

            $table->unique(['street_name', 'country_id']);

            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
