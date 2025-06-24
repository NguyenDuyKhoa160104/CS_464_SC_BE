<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dich_vus', function (Blueprint $table) {
            $table->id();
            $table->string("ten_dich_vu");
            $table->string("mo_ta_dich_vu");
            $table->integer("gia_dich_vu");
            $table->integer("thoi_luong")->comment("Tính theo phút");
            $table->string("hinh_anh");
            $table->integer("tinh_trang");
            $table->integer("id_danh_muc");
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('dich_vus');
    }
};
