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
        Schema::create('order_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamp('order_date');
            $table->foreignUuid('address_id')->references('id')->on('addresses')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('order_total', 8, 2);
            $table->foreignUuid('order_status_id')->references('id')->on('order_statuses')->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
