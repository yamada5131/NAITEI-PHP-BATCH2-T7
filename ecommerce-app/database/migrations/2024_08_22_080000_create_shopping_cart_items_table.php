<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopping_cart_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('shopping_cart_id')->references('id')->on('shopping_carts')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('product_id')->references('id')->on('products')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_cart_items');
    }
};
