<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('order_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('sku',255);
            $table->integer('item_id');
            $table->string('carrier',255);
            $table->integer('volume');
            $table->integer('status');
            $table->tinyInteger('print_count');
            $table->string('market_name',255);
            $table->integer('market_order_id');
            $table->string('supplier_product_name',255);
            $table->integer('supplier_image_link');
            $table->string('product_link',255);
            $table->integer('past_order_count');
            $table->tinyInteger('is_confirm');
            $table->integer('ordered');
            $table->integer('available');
            $table->integer('in_transit');
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
        Schema::drop('order_items');
    }
}
