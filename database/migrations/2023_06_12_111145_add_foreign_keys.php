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
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
//
            $table->foreign('user_id')->references('id')->on('users');
//
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('id')->on('payment_details');
        });
        Schema::table('product_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('size_id')->references('id')->on('sizes');
        });
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('discount_id');
//            $table->unsignedBigInteger('brands_id');
            $table->foreign('category_id')->references('id')->on('product_categories');
            $table->foreign('discount_id')->references('id')->on('discount');
//            $table->foreign('product_entry_id')->references('product_entry_id')->on('product_entries');
//            $table->foreign('brands_id')->references('brands_id')->on('brands');

        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('order_details');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['order_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['discount_id']);
            $table->dropForeign(['product_entry_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('product_entries', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropForeign(['size_id']);
        });

        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['payment_id']);
        });
    }
};
