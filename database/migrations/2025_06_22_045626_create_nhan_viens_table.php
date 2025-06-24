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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->string("password");
            $table->string("ten_nhan_vien");
            $table->string("so_dien_thoai");
            $table->string("hinh_anh");
            $table->integer("tinh_trang");
            $table->integer("id_quyen")->comment("1:Quản lý, 0:Nhân viên");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
