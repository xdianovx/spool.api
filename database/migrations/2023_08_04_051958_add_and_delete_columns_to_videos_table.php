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
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('minimum_age');
            $table->dropColumn('partners_company_id');
            $table->dropColumn('category_id');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->integer('duration');
            $table->integer('minimum_age');
            $table->integer('partners_company_id');
            $table->integer('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('duration');
            $table->dropColumn('minimum_age');
            $table->dropColumn('partners_company_id');
            $table->dropColumn('category_id');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->string('duration');
            $table->string('minimum_age');
            $table->foreignId('partners_company_id')->constrained();
            $table->foreignId('category_id')->constrained();
        });
    }
};
