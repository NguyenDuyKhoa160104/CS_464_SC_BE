<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
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

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
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
        }
    }

    public function changeStatus(Request $request)
    {
        //
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(Request $request)
    {
        //
    }
}
