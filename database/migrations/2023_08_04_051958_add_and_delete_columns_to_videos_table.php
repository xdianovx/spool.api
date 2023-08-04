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
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->integer('duration');
            $table->integer('minimum_age');
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
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->string('duration');
            $table->string('minimum_age');
        });
    }
};
