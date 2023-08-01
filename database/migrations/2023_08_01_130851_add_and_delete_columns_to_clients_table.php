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
            $table->dropColumn('age');
            $table->dropColumn('phone_number');
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->integer('phone_number')->nullable();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->integer('age')->nullable();
            $table->integer('phone_number')->nullable();
        });
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->dropColumn('phone_number');
        });
    }
};
