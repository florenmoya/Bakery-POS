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
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->string('UPC')->nullable();
            $table->string('EAN')->nullable();
            $table->string('custom_SKU')->nullable();
            $table->string('manufacture_SKU')->nullable();
            $table->string('category_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('tags_id')->nullable();
            $table->string('vendor_id')->nullable();
            $table->Integer('reorder_point')->nullable();
            $table->Integer('inventory_level')->nullable();
            $table->Integer('price')->default(0);
            $table->Integer('tax')->nullable();
            $table->Integer('msrp')->nullable();
            $table->Integer('cost')->nullable();
            $table->Integer('stock')->nullable();
            $table->Integer('company_id');
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
