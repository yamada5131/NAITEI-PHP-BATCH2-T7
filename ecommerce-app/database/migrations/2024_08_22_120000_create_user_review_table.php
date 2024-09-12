<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('order_item_id')->references('id')->on('order_items')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_reviews');
    }
};
