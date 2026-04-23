<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderID')->nullable();
            $table->string('organizationID')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('enquiryID')->nullable();
            $table->string('propasalID')->nullable();
            $table->string('entryLevel')->nullable();
            $table->string('subtotal')->nullable();
           
            $table->string('discount_amount')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('balance')->nullable();
            $table->string('status')->default('1');
            $table->string('exp_date')->default('0');
            $table->string('path');
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
        Schema::dropIfExists('invoices');
    }
}
