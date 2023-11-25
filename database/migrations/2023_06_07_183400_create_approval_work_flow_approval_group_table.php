<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalWorkFlowApprovalGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('approval_work_flow_approval_group', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('approval_work_flow_id')->constrained()->onDelete('cascade');
            $table->foreignId('approval_group_id')->constrained()->onDelete('cascade');
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
        Schema::drop('approval_work_flow_approval_group');
    }
}
