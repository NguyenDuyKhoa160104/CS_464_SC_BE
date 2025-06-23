<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KhachHangController extends Controller
{
    public function getData()
    {
        $data = KhachHang::get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                KhachHang::create([
                    "ten_khach_hang"        => $request->ten_khach_hang,
                    "email"                 => $request->email,
                    "so_dien_thoai"         => $request->so_dien_thoai,
                    "tinh_trang"            => 1
                ]);
                return response()->json([
                    'status'  => true,
                    'message' => "Đã thêm mới khách hàng thành công!"
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
                $khach_hang = KhachHang::where("id", $request->id)->first();
                if ($khach_hang) {
                    $khach_hang->tinh_trang = !$khach_hang->tinh_trang;
                    $khach_hang->save();
                    return response()->json([
                        'status'  => true,
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message' => "Khách hàng không tồn tại!"
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                KhachHang::where("id", $request->id)->update([
                    "ten_khach_hang"        => $request->ten_khach_hang,
                    "email"                 => $request->email,
                    "so_dien_thoai"         => $request->so_dien_thoai,
                ]);
                return response()->json([
                    'status'  => true,
                    'message' => "Đã cập nhật khách hàng thành công!"
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
                KhachHang::where("id", $request->id)->delete();
                return response()->json([
                    'status'  => true,
                    'message' => "Đã xóa khách hàng thành công!"
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
