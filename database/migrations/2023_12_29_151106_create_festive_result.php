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
        Schema::create('festive_result', function (Blueprint $table) {
            $table->id();
            $table->integer('festive_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->string('cat_url')->nullable();
            $table->string('product_url')->nullable();
            $table->decimal('qty')->nullable();
            $table->string('measure')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('total')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festive_result');
    }
};
