<?php

use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\SanPhamController;
use App\Http\Middleware\NhanVienMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/nhan-vien/dang-nhap', [NhanVienController::class, 'login']);
Route::post('/nhan-vien/create', [NhanVienController::class, 'store'])->middleware("NhanVienMiddle");

Route::get('/nhan-vien/danh-muc/data', [DanhMucController::class, 'getData']);
Route::post('/nhan-vien/danh-muc/create', [DanhMucController::class, 'store'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/doi-trang-thai', [DanhMucController::class, 'changeStatus'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/update', [DanhMucController::class, 'update'])->middleware("NhanVienMiddle");
Route::post('/nhan-vien/danh-muc/delete', [DanhMucController::class, 'destroy'])->middleware("NhanVienMiddle");

Route::get('/nhan-vien/san-pham/data', [SanPhamController::class, 'getData']);
Route::post('/nhan-vien/san-pham/create', [SanPhamController::class, 'store'])->middleware("NhanVienMiddle");