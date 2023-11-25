<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTerminationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_terminations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contract_id')->constrained();
            $table->date('date_of_termination');
            $table->longText('reasons');
            $table->bigInteger('attachment_id');
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
        Schema::drop('contract_terminations');
    }
}
