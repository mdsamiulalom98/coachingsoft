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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('mentor_id');
            $table->string('title');
            $table->string('total_class')->length(55);
            $table->string('time')->length(55);
            $table->string('image');
            $table->integer('old_fee')->length(6)->nullable();
            $table->integer('course_fee')->length(6);
            $table->longText('description');
            $table->text('why_us')->nullable();
            $table->string('video')->length(155);
            $table->string('category')->length(25);
            $table->string('course_type')->length(25);
            $table->tinyInteger('status')->length(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
