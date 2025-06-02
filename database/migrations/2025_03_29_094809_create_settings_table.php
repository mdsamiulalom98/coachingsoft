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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(155);
            $table->string('white_logo')->length(255);
            $table->string('dark_logo')->length(255);
            $table->string('favicon')->length(255);
            $table->string('copy_right')->length(155);
            $table->string('primary_color')->length(8);
            $table->string('secondary_color')->length(8);
            $table->string('extra_color')->length(8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
