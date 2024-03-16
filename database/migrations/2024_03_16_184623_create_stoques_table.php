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
        Schema::create('stoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contacto_id')->nullable();
            $table->string('metodo_pagamento');
            $table->decimal('total_pagar');
            $table->string('estado')->default('off');
            $table->timestamps();

            $table->foreign('contacto_id')->references('id')->on('contactos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoques');
    }
};
