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
            $table->integer('tickets_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->boolean('ticket_availability')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('tickets_count');
            $table->dropColumn('views_count');
            $table->dropColumn('ticket_availability');
        });
    }
};
