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
        Schema::create('client_cards', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('card_mask');
            $table->string('bank');
            $table->string('rebill_id');
            $table->string('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_cards');
    }
};
