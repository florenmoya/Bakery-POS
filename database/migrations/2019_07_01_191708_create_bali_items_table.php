<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaliItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bali_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('balis_id');
            $table->string('description');
            $table->string('type');
            $table->Integer('price');
            $table->Integer('quantity');
            $table->string('category');
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
        Schema::dropIfExists('bali_items');
    }
}
