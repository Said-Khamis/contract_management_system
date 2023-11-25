<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractPartiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contract_parties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contract_id')->constrained();
            $table->foreignId('institution_id')->constrained();
            $table->boolean('is_main')->nullable();
            $table->boolean('is_local');
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
        Schema::drop('contract_parties');
    }
}
