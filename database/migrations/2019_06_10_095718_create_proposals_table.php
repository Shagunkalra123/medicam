<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->string('related');
            $table->string('to');
            $table->string('organization_name');
            $table->string('address',500);
            $table->string('status');
            $table->string('assigned');          
            $table->string('date');
            $table->string('open_till');           
            $table->string('currency');
           
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zipcode',30);
            $table->string('email');
            $table->string('phone',30);
           
            $table->string('sub_total');           
            
          
            $table->string('Fr_charges');
          
         
           

            $table->string('path');           
           
            $table->string('enqid_hidden');
            $table->string('entryLevelHidden');
           
            $table->string('organization_id');
            
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
        Schema::dropIfExists('proposals');
    }
}
