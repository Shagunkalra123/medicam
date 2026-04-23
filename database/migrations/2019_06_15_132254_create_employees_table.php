<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emp_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('emp_username')->unique();
            $table->string('password')->nullable();
            $table->string('emp_email')->unique();
            $table->bigInteger('emp_contact')->nullable();
            $table->string('gender')->nullable();
            $table->string('Marital_status')->nullable();
            $table->string('dob')->nullable();
            $table->string('designation')->nullable();
            $table->string('address',500)->nullable();
            $table->string('blood_group')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relation')->nullable();
            $table->bigInteger('relative_contact')->nullable();
            $table->string('relative_address',500)->nullable();
            $table->string('employee_photo')->nullable();
            $table->string('upload_employee_photo')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
