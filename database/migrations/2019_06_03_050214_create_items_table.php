<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('type')->nullable();
            $table->string('brand')->nullable();
            $table->string('tags')->nullable();
            $table->string('vendor')->nullable();
            $table->Integer('reorder_point')->nullable();
            $table->Integer('reorder_level')->nullable();
            $table->Integer('price');
            $table->Integer('item_cost')->nullable();
            $table->Integer('quantity')->nullable();
            $table->string('category')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('items');
    }
}
