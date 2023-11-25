<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('employee_id')->comment('Check/File Number');
            $table->string('nin')->comment('National Identification number');
            $table->string('name');
            $table->date('birth_date');
            $table->string('gender');
            $table->date('employment_date');
            $table->string('duty_station');
            $table->foreignId('designation_id')->constrained();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('employees');
    }
}
