<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractResponsibilityStatusesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contract_responsibility_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contract_responsibility_id');
            $table->integer('status');
            $table->longText('comment')->nullable();
            $table->timestamp('status_updated_at')->default(now());
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
        Schema::drop('contract_responsibility_statuses');
    }
}
