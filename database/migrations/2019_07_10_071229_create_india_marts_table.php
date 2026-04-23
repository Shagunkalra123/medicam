<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndiaMartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('india_marts', function (Blueprint $table) {
            $table->bigIncrements('id');
           
            $table->string('byer_name')->nullable();
            $table->string('address',500)->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->string('quantity')->nullable();
            


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
        Schema::dropIfExists('india_marts');
    }
}
