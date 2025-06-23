<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    protected $table = "san_phams";

    protected $fillable = [
        "id_danh_muc",
        "ten_san_pham",
        "gia_san_pham",
        "mo_ta",
        "mo_ta_chi_tiet",
        "hinh_anh",
        "tinh_trang",
    ];

    
}
