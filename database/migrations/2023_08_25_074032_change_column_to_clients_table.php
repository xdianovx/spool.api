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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('last_login_date');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dateTime('last_login_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('last_login_date');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->date('last_login_date')->nullable();
        });
    }
};
