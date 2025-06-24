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
              DB::statement('ALTER TABLE books ALTER COLUMN rating TYPE double precision USING rating::double precision');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
              DB::statement('ALTER TABLE books ALTER COLUMN rating TYPE smallint USING rating::smallint');
        });
    }
};
