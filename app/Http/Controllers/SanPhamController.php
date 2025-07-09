<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    public function getData()
    {
        $data = SanPham::get();

        return response()->json([
            'data'  => $data
        ]);
    }
    
    public function getDataOpen()
    {
        $data = SanPham::where("tinh_trang", 1)->get();

        return response()->json([
            'data'  => $data
        ]);
    }

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                SanPham::create([
                    "id_danh_muc"               => $request->id_danh_muc,
                    "ten_san_pham"              => $request->ten_san_pham,
                    "gia_san_pham"              => $request->gia_san_pham,
                    "mo_ta"                     => $request->mo_ta,
                    "mo_ta_chi_tiet"            => $request->mo_ta_chi_tiet,
                    "hinh_anh"                  => $request->hinh_anh,
                    "tinh_trang"                => 1,
                ]);

                return response()->json([
                    'status'  => true,
                    'message' => "Đã thêm mới sản phẩm thành công!"
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
                $san_pham = SanPham::where("id", $request->id)->first();
                if ($san_pham) {
                    $san_pham->tinh_trang = !$san_pham->tinh_trang;

                    $san_pham->save();

                    return response()->json([
                        'status'  => true,
                    ]);
                } else {
                    return response()->json([
                        'status'        => false,
                        'message'       => 'Sản phẩm không tồn tại!'
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
                SanPham::where("id", $request->id)->update([
                    "id_danh_muc"               => $request->id_danh_muc,
                    "ten_san_pham"              => $request->ten_san_pham,
                    "gia_san_pham"              => $request->gia_san_pham,
                    "mo_ta"                     => $request->mo_ta,
                    "mo_ta_chi_tiet"            => $request->mo_ta_chi_tiet,
                    "hinh_anh"                  => $request->hinh_anh,
                ]);
                return response()->json([
                    'status'        => true,
                    'message'       => 'Đã cập nhật sản phẩm thành công!'
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
                SanPham::where("id", $request->id)->delete();
                return response()->json([
                    'status'        => true,
                    'message'       => 'Đã xóa sản phẩm thành công!'
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
