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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id')->index()->length(6);
            $table->integer('class_id')->index()->length(6);
            $table->integer('session_id')->index()->length(6);
            $table->integer('batch_id')->index()->length(6);
            $table->integer('student_id')->index()->length(6);
            $table->integer('roll_number')->index()->length(25);
            $table->date('result_date');
            $table->integer('exam_id')->index()->length(6);
            $table->string('marks')->length(6);
            $table->string('cq')->length(6)->nullable();
            $table->string('mcq')->length(6)->nullable();
            $table->string('hs')->length(6)->nullable();
            $table->string('position')->length(6)->nullable();
            $table->string('note')->length(6)->nullable();
            $table->tinyInteger('status')->length(4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
