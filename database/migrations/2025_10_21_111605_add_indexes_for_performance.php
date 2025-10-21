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
        Schema::table('books', function (Blueprint $table) {
            $table->index('average_rating');
            $table->index('title');
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->index('total_high_ratings');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['average_rating']);
            $table->dropIndex(['title']);
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->dropIndex(['total_high_ratings']);
            $table->dropIndex(['name']);
        });
    }
};
