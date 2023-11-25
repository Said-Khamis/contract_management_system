<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractOperationAreasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_operation_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contract_id')->constrained();
            $table->foreignId('contract_operation_area_id')->nullable()->constrained();
            $table->string('area');
            $table->longText('details')->nullable();
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
    public function down()
    {
        Schema::drop('contract_operation_areas');
    }
}
