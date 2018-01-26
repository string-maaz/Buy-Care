<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('carrier', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('carrier_code',255);
            $table->string('services',50);
            $table->string('service_format',50);
            $table->string('service_enhancement',50);
            $table->text('condition');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('carrier');
    }
}
