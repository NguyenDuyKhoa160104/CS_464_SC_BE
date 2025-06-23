<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = "khach_hangs";

    protected $fillable = [
        "ten_khach_hang",
        "email",
        "so_dien_thoai",
        "tinh_trang",
    ];
}
