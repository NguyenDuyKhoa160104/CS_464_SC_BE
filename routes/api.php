<?php

use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\DichVuController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SanPhamController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/nhan-vien/dang-xuat-all', [NhanVienController::class, 'logoutAll'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dang-nhap', [NhanVienController::class, 'login']);
Route::get('/nhan-vien/data', [NhanVienController::class, 'getData']);
Route::get('/nhan-vien/data-dang-nhap', [NhanVienController::class, 'getDataDangNhap'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dang-xuat', [NhanVienController::class, 'logout'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/create', [NhanVienController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/update', [NhanVienController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/doi-tinh-trang', [NhanVienController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::get('/kiem-tra-admin', [NhanVienController::class, 'kiemTraAdmin']);

Route::get('/nhan-vien/danh-muc/data', [DanhMucController::class, 'getData']);
Route::get('/nhan-vien/danh-muc/data-open', [DanhMucController::class, 'getDataOpen']);
Route::post('/nhan-vien/danh-muc/create', [DanhMucController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/doi-trang-thai', [DanhMucController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/update', [DanhMucController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/delete', [DanhMucController::class, 'destroy'])->middleware("NhanVienMiddle");

Route::get('/nhan-vien/san-pham/data', [SanPhamController::class, 'getData']);
Route::post('/nhan-vien/san-pham/create', [SanPhamController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/san-pham/doi-tinh-trang', [SanPhamController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/san-pham/update', [SanPhamController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/san-pham/delete', [SanPhamController::class, 'destroy'])->middleware("NhanVienMiddle");

Route::get('/nhan-vien/khach-hang/data', [KhachHangController::class, 'getData']);
Route::post('/nhan-vien/khach-hang/create', [KhachHangController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/khach-hang/doi-trang-thai', [KhachHangController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/khach-hang/update', [KhachHangController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/khach-hang/delete', [KhachHangController::class, 'destroy'])->middleware("NhanVienMiddle");

Route::get('/nhan-vien/dich-vu/data', [DichVuController::class, 'getData']);
Route::post('/nhan-vien/dich-vu/create', [DichVuController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dich-vu/doi-trang-thai', [DichVuController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dich-vu/doi-trang-thai', [DichVuController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dich-vu/update', [DichVuController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/dich-vu/delete', [DichVuController::class, 'destroy'])->middleware("NhanVienMiddle");
