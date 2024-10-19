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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code', 255)->unique();
            $table->string('product_name', 255);
            $table->string('category_id', 255);
            $table->float('price');
            $table->string('image', 255);
            $table->text("options", 65535);
            $table->integer('unsold_quantity');
            $table->integer('sold_quantity');
            $table->string('description', 255)->nullable();
            $table->string('review_and_comment', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
