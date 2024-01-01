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
        Schema::table('recipe', function (Blueprint $table) {
            $table->decimal('count_serving')->nullable();
            $table->integer('cook_time')->nullable();
            $table->string('author')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipe', function (Blueprint $table) {
            $table->dropColumn('count_serving');
            $table->dropColumn('cook_time');
            $table->dropColumn('author');
        });
    }
};
