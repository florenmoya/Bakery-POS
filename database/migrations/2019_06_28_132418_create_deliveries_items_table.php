<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveriesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('deliveries_id');
            $table->Integer('item_id');
            $table->Integer('price');
            $table->Integer('item_cost')->nullable();
            $table->Integer('quantity');
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
        Schema::dropIfExists('deliveries_items');
    }
}
