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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->decimal('price', 15)->nullable();
            $table->string('status')->nullable();
            $table->foreignId('id_type')->nullable();
            $table->text('information')->nullable();
            $table->text('image_url')->nullable();
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('dish_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dishes');
    }
};
