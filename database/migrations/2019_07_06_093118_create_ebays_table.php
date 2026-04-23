<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_title');
            $table->string('item_id');
            $table->string('order_id');
            $table->string('Buyer_name');          
            $table->string('byer_email');
            $table->string('SaleRecordID');
            $table->string('SalePrice');
            $table->string('order_status_CheckoutStatus');
            $table->string('totalamount');
            $table->string('totalquantity');
            $table->string('paid_status');
            $table->string('payment_method');
            $table->string('image_url');
            $table->string('order_date');

            $table->string('Buyer_id');
            $table->string('address');
            $table->string('city_name');
            $table->string('country_name');
            $table->string('phone');
            $table->string('postalcode');
            $table->string('amountpaid');
            $table->string('completion_token');


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
        Schema::dropIfExists('ebays');
    }
}
