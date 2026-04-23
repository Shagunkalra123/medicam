<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceParticularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_particulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Product');
            $table->string('qty');
            $table->string('price');
            $table->string('product_total');           
            $table->string('igst');           
            $table->string('cgst');           
            $table->string('sgst');           
            $table->string('discount');           
            $table->string('Co_ordinated_with');           
            $table->integer('invoice_id');                    
            $table->foreign('invoice_id')->references('id')->on('invoices');
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
        Schema::dropIfExists('invoice_particulars');
    }
}
