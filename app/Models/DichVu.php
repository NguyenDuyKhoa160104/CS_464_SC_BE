<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DichVu extends Model
{
    protected $table = "dich_vus";

    protected $fillable = [
        "ten_dich_vu",
        "mo_ta_dich_vu",
        "gia_dich_vu",
        "thoi_luong",
        "hinh_anh",
        "tinh_trang",
        "id_danh_muc",
    ];
}
