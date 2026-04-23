<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_name_acc')->nullable();
            $table->string('organization_name')->nullable()->unique();
            $table->string('fax')->nullable();
            $table->string('gst')->nullable();
            $table->string('industry')->nullable();
            $table->string('landmark')->nullable();
            $table->string('city_town')->nullable();
            $table->bigInteger('postal_code')->nullable();
            $table->string('mobile_number')->unique()->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('primary_email')->unique()->nullable();
            $table->string('unique_id')->nullable();
            $table->string('data_source')->nullable();
            $table->string('address')->nullable();
            $table->string('select_branch')->nullable();
            $table->string('organization_type')->nullable();
            $table->string('email_id')->unique()->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('secondary_email')->nullable();
            $table->string('telecaller')->nullable();
            $table->string('zone')->nullable();
            $table->string('country')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('Assign_To')->nullable();
            $table->string('website')->nullable();
            $table->string('sales_person')->nullable();
            $table->string('area')->nullable();
            $table->string('state')->nullable();
            $table->string('sub_Priority_1')->nullable();
            $table->string('sub_Priority_2')->nullable();
            $table->string('description',500)->nullable();
            $table->string('preference_token')->nullable();

            $table->string('association_with_medicam',100)->nullable();

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
        Schema::dropIfExists('clients');
    }
}
