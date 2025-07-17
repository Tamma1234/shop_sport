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
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->decimal('additional_price', 10, 2)->default(0.00); // Giá thêm cho size này (nếu có)
            $table->boolean('active')->default(true);
            $table->timestamps();

            // Tạo unique constraint để đảm bảo không có sự trùng lặp product-size
            $table->unique(['product_id', 'size_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
