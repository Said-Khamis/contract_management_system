<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalHistoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('approval_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('approval_id')->constrained();
            $table->foreignId('role_id')->nullable();//todo add constraints when role is added
            $table->boolean('is_approved')->default(false);
            $table->string('comment');
            $table->integer('approved_by')->unsigned();
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
    public function down(): void
    {
        Schema::drop('approval_histories');
    }
}
