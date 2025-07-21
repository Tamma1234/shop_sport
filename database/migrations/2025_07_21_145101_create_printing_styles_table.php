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
        Schema::create('printing_styles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('printing_id')->constrained()->onDelete('cascade');
            $table->string('name'); // VD: In nhiệt, In decal, In pet
            $table->integer('price'); // giá cho kiểu in này
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printing_styles');
    }
};
