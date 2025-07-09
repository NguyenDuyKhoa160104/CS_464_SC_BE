<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    protected $table = 'hoa_dons';

    protected $fillable = [
        'ma_hoa_don',
        'ten_khach_hang',
        'so_dien_thoai',
        'tong_tien',
        'tinh_trang',
    ];

    public function chiTiet()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'id_hoa_don');
    }

    
}
