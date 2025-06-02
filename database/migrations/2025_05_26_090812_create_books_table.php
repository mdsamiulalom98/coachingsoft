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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('mentor_id');
            $table->string('category_id')->length(25);
            $table->string('title');
            $table->string('total_page')->length(55);
            $table->string('image');
            $table->integer('price')->length(6);
            $table->integer('old_price')->length(6)->nullable();
            $table->longText('description');
            $table->string('stock')->length(25);
            $table->tinyInteger('status')->length(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
