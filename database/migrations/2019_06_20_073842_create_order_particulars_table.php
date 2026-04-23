<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_particulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('products');
            $table->string('qty');
            $table->string('price');
            $table->string('total');
            $table->string('sgst');
            $table->string('igst');
            $table->string('cgst');
            $table->string('discount');
            $table->integer('orders_id');
            $table->foreign('orders_id')->references('id')->on('main_orders');
            $table->integer('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('order_particulars');
    }
}
