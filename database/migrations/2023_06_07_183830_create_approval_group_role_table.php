<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalGroupRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('approval_group_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('approval_group_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->nullable();//todo add constraint when role available
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop('approval_group_role');
    }
}
