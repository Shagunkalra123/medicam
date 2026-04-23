<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followups', function (Blueprint $table) {
            $table->bigIncrements('id');
          
            $table->string('rem_date')->nullable();
            $table->string('rem_time')->nullable();
            $table->string('subject')->nullable();
            $table->string('note',600)->nullable();
            $table->string('nature')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('enquiry_id')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('mobile')->nullable();
            $table->string('Contact_Persone_Name')->nullable();
            $table->string('product')->nullable();
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
        Schema::dropIfExists('followups');
    }
}
