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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // ID tự động tăng
            $table->unsignedInteger('quality'); // Số lượng
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Khóa ngoại cho đơn hàng
            $table->unsignedBigInteger('product_id'); // Đảm bảo kiểu dữ liệu chính xác

            // Định nghĩa khóa ngoại cho product_id
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade'); // Giả sử bạn đã có bảng products
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
