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
        Schema::create('item_stoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stoque_id');
            $table->unsignedBigInteger('produto_id');
            $table->decimal('preco_unitario')->nullable();
            $table->integer('quantidade');
            $table->text('observacao')->nullable();
            $table->string('estado')->default('on');
            $table->timestamps();

            $table->foreign('stoque_id')->references('id')->on('stoques')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_stoques');
    }
};
