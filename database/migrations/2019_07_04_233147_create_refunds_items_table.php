<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('refunds_id');
            $table->Integer('item_id');
            $table->Integer('company_id');
            $table->Integer('price');
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
        Schema::dropIfExists('refunds_items');
    }
}
