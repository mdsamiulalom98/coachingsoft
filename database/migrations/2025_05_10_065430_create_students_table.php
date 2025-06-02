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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            // basic info
            $table->integer('department_id')->index();
            $table->integer('class_id')->index();
            $table->integer('session_id')->index();
            $table->integer('batch_id')->index();
            $table->string('name',155);
            $table->string('bn_name',155)->nullable();
            $table->string('nick_name',99)->nullable();
            $table->string('bn_nick_name',99)->nullable();
            $table->string('roll_number', 155);
            $table->string('phone_number',11)->nullable();
            $table->string('dob', 50);
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('image')->default('public/avatar/avatar.png');

            // parents information
            $table->string('father_name',191);
            $table->string('father_phone',11)->nullable();
            $table->string('father_profession',55)->nullable();
            $table->string('mother_name', 191);
            $table->string('mother_phone', 11)->nullable();
            $table->string('mother_profession',55)->nullable();
            $table->string('local_guardian',155)->nullable();
            $table->string('lg_relation',55)->nullable();

            $table->string('add_date', 191);
            $table->integer('course_fee')->default(0);
            $table->string('password');
            $table->string('verify')->nullable();
            $table->string('reset_token')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
