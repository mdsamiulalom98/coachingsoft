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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->index()->length(6);
            $table->integer('class_id')->index()->length(6);
            $table->integer('session_id')->index()->length(6);
            $table->integer('batch_id')->index()->nullable()->length(6);
            $table->string('title')->length(155);
            $table->string('exam_code')->index()->nullable()->length(155);
            $table->string('marks')->length(6);
            $table->string('cq')->nullable()->length(6);
            $table->string('mcq')->nullable()->length(6);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
