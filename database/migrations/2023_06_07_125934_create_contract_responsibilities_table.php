<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractResponsibilitiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contract_responsibilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('contract_id')->constrained();
            //$table->foreignId('contract_party_id')->nullable()->constrained();
            $table->longText('details');
            //$table->dateTime('start_time')->nullable();
            //$table->dateTime('end_time')->nullable();
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
        Schema::dropIfExists('contract_responsibilities');
    }
}
