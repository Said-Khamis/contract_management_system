<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApprovalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('approvable');
            $table->boolean('is_approved')->default(false);
            $table->string('status');
            $table->integer('current_approval_work_flow_id')->unsigned()->nullable();
            $table->integer('current_approval_group_id')->unsigned()->nullable();
            $table->integer('current_approval_role_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::drop('approvals');
    }
}
