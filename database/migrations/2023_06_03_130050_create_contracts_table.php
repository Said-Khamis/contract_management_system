<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('contractss', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('signed_place')->nullable();
            $table->string('type');
            $table->longText('title');
            $table->string('reference_no')->nullable();
            $table->dateTime('signed_at')->nullable();
            $table->dateTime('ratified_at')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('amended')->default(false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->boolean('auto_renewal')->default(false);
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
        Schema::drop('contractss');
    }
}
