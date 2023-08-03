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
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('category_id');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('parent_id');

        });
    }
};
