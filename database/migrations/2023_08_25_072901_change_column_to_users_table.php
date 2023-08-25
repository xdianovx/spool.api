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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_date');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('last_login_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_date');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->date('last_login_date')->nullable();
        });
    }
};
