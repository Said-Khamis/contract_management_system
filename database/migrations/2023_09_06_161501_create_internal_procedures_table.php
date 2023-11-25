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
        Schema::create('internal_procedures', function (Blueprint $table) {
            $table->id();
            $table->morphs('procedurable');
            $table->foreignId('from_institution_id')->references('id')->on('institutions')->onDelete('restrict');
            $table->foreignId('to_institution_id')->nullable()->references('id')->on('institutions')->onDelete('restrict');
            $table->text('status');
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
        Schema::dropIfExists('internal_procedures');
    }
};