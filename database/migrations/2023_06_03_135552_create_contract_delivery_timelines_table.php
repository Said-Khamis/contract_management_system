<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDeliveryTimelinesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_delivery_timelines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contract_id')->constrained();
            $table->longText('details')->nullable();
            $table->longText('title')->nullable();
            $table->string('time')->nullable();
            $table->string('type')->nullable();
            $table->string('duration')->nullable();
            $table->string('unit')->nullable();
            $table->string('annual_event')->nullable();
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
        Schema::drop('contract_delivery_timelines');
    }
}
