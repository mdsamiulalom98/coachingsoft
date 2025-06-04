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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->index();
            $table->date('date')->index();
            $table->date('amount');
            $table->string('month')->length(25);
            $table->string('paid_by')->length(155)->nullable();
            $table->tinyInteger('type')->length(2);
            $table->tinyInteger('status')->length(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
