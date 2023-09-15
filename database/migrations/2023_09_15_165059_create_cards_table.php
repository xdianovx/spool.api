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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('Event')->nullable();
            $table->string('TransactionId')->nullable();
            $table->string('OrderId')->nullable();
            $table->string('Amount')->nullable();
            $table->string('Currency')->nullable();
            $table->string('DateTime')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Service_Id')->nullable();
            $table->string('Description')->nullable();
            $table->string('Bank')->nullable();
            $table->string('Country_Code_Alpha2')->nullable();
            $table->string('CardMasked')->nullable();
            $table->string('CardHolder')->nullable();
            $table->string('Brand')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
