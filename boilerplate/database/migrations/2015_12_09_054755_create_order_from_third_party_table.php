<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderFromThirdPartyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order_from_third_party', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('item_id',false);
            $table->string('order_place_from',255);
            $table->string('order_value',255);
            $table->string('tracking_no',255);
            $table->timestamps();
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
        Schema::drop('order_from_third_party');
    }
}
