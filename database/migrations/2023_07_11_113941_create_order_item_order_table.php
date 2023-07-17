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
        Schema::create('order_details_order_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_details_id');
            $table->unsignedBigInteger('order_item_id');
            $table->timestamps();

            $table->foreign('order_details_id')->references('id')->on('order_details')->onDelete('cascade');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_order');
    }
};
