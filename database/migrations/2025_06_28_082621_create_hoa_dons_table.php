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
        Schema::create('hoa_dons', function (Blueprint $table) {
            $table->id();
            $table->string("ma_hoa_don")->unique();
            $table->integer("id_khach_hang");
            $table->integer("id_nhan_vien");
            $table->string("ten_khach_hang")->nullable();
            $table->integer("tong_tien")->default(0);
            $table->string("trang_thai");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
