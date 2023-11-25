<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImplementationStatusesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('implementation_statuses', function (Blueprint $table) {
            $table->id();
            $table->morphs('implementable', 'implementation_statuses_implementable_index');
            $table->foreignId('contract_id')->constrained();
            $table->longText('comment');
            $table->double('percent');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable();
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
        Schema::drop('implementation_statuses');
    }
}
