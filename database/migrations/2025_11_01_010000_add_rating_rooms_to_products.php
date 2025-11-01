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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'rating')) {
                // rating between 0.00 and 9.99 — we'll clamp in model to 0..5
                $table->decimal('rating', 3, 2)->nullable()->after('image');
            }
            if (!Schema::hasColumn('products', 'rooms')) {
                $table->unsignedInteger('rooms')->nullable()->after('rating');
            }
            if (!Schema::hasColumn('products', 'amenities')) {
                $table->text('amenities')->nullable()->after('rooms');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'amenities')) {
                $table->dropColumn('amenities');
            }
            if (Schema::hasColumn('products', 'rooms')) {
                $table->dropColumn('rooms');
            }
            if (Schema::hasColumn('products', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }
};
