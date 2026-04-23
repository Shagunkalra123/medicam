<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_person_name')->nullable();
            $table->string('org_id')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email_id')->nullable();
            $table->string('Warranty_date')->nullable();
            $table->string('address',500)->nullable();
            $table->string('subtotal')->nullable();
            
            $table->string('grand_total')->nullable();
            $table->string('is_active')->default('1');
            $table->string('enqid_hidden')->nullable();
            $table->string('entryLevelHidden')->nullable();
            $table->string('proposalIDHidden')->nullable();
            $table->string('button_disable')->default('0');
            $table->string('exp_date')->default('0');
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
        Schema::dropIfExists('main_orders');
    }
}
