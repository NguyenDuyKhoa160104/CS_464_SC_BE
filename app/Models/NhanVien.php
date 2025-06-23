<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NhanVien extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = "nhan_viens";

    protected $fillable = [
        "email",
        "password",
        "ten_nhan_vien",
        "so_dien_thoai",
        "tinh_trang",
        "id_quyen",
    ];
}
