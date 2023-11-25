<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('procedure_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internal_procedure_id')->constrained();
            $table->foreignId('from_user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('to_user_id')->nullable()->references('id')->on('users')->onDelete('restrict');
            $table->text('comment');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedure_comment');
    }
};
