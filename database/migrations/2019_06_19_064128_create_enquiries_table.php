<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Select_Contact_person')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('organisation_id')->nullable();
            $table->string('EnquiryDataSource_Name')->nullable();
            $table->string('ReferredBy_Name')->nullable();
            $table->string('EnquiryType_Name')->nullable();
           
            $table->string('Expected_closed_Date')->nullable();
            
           
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
        Schema::dropIfExists('enquiries');
    }
}
