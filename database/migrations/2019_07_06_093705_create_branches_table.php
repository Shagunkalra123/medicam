<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Branch_Name');
            $table->string('Branch_Manager');
            $table->string('Company');
            $table->string('Contact_No');
            $table->string('GSTIN_UIN');
            $table->string('Country');
            $table->string('State');
            $table->string('City');
            $table->string('Contact_Address');
            $table->string('Area');
            $table->string('Landmark');
            $table->tinyInteger('is_active')->default('1');
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
        Schema::dropIfExists('branches');
    }
}
