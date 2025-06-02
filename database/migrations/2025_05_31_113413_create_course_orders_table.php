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
        Schema::create('course_orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->length(8);
            $table->integer('student_id');
            $table->integer('course_id');
            $table->string('amount')->length(11);
            $table->string('name')->length(155);
            $table->string('phone')->length(155);
            $table->string('address')->length(255);
            $table->string('method')->length(55)->nullable();
            $table->string('trx_id')->length(55)->nullable();
            $table->string('sender_number')->length(55)->nullable();
            $table->string('status')->length(55);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_orders');
    }
};
