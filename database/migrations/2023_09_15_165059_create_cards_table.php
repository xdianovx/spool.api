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
            $table->string('TransactionId');
            $table->string('OrderId');
            $table->string('Amount');
            $table->string('Currency');
            $table->string('DateTime');
            $table->string('Email');
            $table->string('Phone');
            $table->string('Service_Id');
            $table->string('Description');
            $table->string('Bank');
            $table->string('Country_Code_Alpha2');
            $table->string('CardMasked');
            $table->string('CardHolder');
            $table->string('Brand');
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
