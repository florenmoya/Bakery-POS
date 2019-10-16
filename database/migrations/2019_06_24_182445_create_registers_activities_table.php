<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('starting_amount')->nullable();
            $table->Integer('released_amount')->nullable();
            $table->Integer('starting_user')->nullable();
            $table->Integer('released_user')->nullable();
            $table->Integer('company_id');
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
        Schema::dropIfExists('registers_activities');
    }
}
