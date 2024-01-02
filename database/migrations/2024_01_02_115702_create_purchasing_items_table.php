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
        Schema::create('purchasing_items', function (Blueprint $table) {
            $table->id();
            $table->integer('purchasing_id');
            $table->integer('item_id');
            $table->double('price', 14, 2)->default(0);
            $table->integer('qty')->default(0);
            $table->double('total', 14, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasing_items');
    }
};
