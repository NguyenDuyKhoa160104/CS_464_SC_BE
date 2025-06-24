<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\DichVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DichVuController extends Controller
{
    public function getData()
    {
        $data = DichVu::get();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                DichVu::create([
                    "ten_dich_vu"       => $request->ten_dich_vu,
                    "mo_ta_dich_vu"     => $request->mo_ta_dich_vu,
                    "gia_dich_vu"       => $request->gia_dich_vu,
                    "thoi_luong"        => $request->thoi_luong,
                    "hinh_anh"          => $request->hinh_anh,
                    "tinh_trang"        => 1,
                    "id_danh_muc"       => $request->id_danh_muc,
                ]);
                return response()->json([
                    'status'  => true,
                    'message' => "Đã thêm mới dịch vụ thành công!"
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Tài khoản của bạn đang tạm khóa!"
                ]);
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                $dich_vu = DichVu::where("id", $request->id)->first();
                if ($dich_vu) {
                    $dich_vu->tinh_trang = !$dich_vu->tinh_trang;
                    $dich_vu->save();
                    return response()->json([
                        'status'  => true,
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Tài khoản của bạn đang tạm khóa!"
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                DichVu::where("id", $request->id)->update([
                    "ten_dich_vu"       => $request->ten_dich_vu,
                    "mo_ta_dich_vu"     => $request->mo_ta_dich_vu,
                    "gia_dich_vu"       => $request->gia_dich_vu,
                    "thoi_luong"        => $request->thoi_luong,
                    "hinh_anh"          => $request->hinh_anh,
                    "id_danh_muc"       => $request->id_danh_muc,
                ]);
                return response()->json([
                    'status'  => true,
                    'message' => "Đã cập nhật dịch vụ thành công!"
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Tài khoản của bạn đang tạm khóa!"
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                DichVu::where("id", $request->id)->delete();
                return response()->json([
                    'status'  => true,
                    'message' => "Đã xóa dịch vụ thành công!"
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Tài khoản của bạn đang tạm khóa!"
                ]);
            }
        }
    }
}
