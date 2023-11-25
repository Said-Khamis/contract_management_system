<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalApprovalWorkFlowTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('approval_approval_work_flow', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('approval_id')->constrained()->onDelete('cascade');
            $table->foreignId('approval_work_flow_id')->constrained()->onDelete('cascade');
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
        Schema::drop('approval_approval_work_flow');
    }
}
