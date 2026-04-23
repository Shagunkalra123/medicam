<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prop_products', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('particulars')->nullable();
            $table->string('qty')->nullable();
            $table->string('price')->nullable();
            $table->string('total')->nullable();
            $table->string('sgst')->nullable();
            $table->string('cgst')->nullable();
            $table->string('igst')->nullable();
            $table->string('discount')->nullable();
           
           $table->integer('proposal_id')->nullable();
           $table->foreign('proposal_id')->references('id')->on('proposals');
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
        Schema::dropIfExists('prop_product');
    }
}
