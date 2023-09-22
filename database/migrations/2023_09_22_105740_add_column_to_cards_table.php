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
        Schema::table('cards', function (Blueprint $table) {
            $table->string('IsTest')->nullable();
            $table->string('CustomFields')->nullable();
            $table->string('PayoutToken')->nullable();
            $table->string('RebillId')->nullable();
            $table->string('ExpirationDate')->nullable();
            $table->string('RRN')->nullable();
            $table->string('RecurringId')->nullable();
            $table->string('Subtype')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn('IsTest');
            $table->dropColumn('CustomFields');
            $table->dropColumn('PayoutToken');
            $table->dropColumn('RebillId');
            $table->dropColumn('ExpirationDate');
            $table->dropColumn('RRN');
            $table->dropColumn('RecurringId');
            $table->dropColumn('Subtype');
        });
    }
};
