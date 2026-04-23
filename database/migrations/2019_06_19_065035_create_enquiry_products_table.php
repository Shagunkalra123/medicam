<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Product')->nullable();
            $table->string('Unit')->nullable();
            $table->string('Price')->nullable();
            $table->string('Assign_To')->nullable();
            $table->string('Requested_Quantity')->nullable();
            $table->string('Co_ordinated_with')->nullable();
            $table->string('nature')->nullable();
            $table->integer('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries');
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
        Schema::dropIfExists('enquiry_products');
    }
}
