<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhMucController extends Controller
{
    public function getData()
    {
        $data = DanhMuc::get();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            DanhMuc::create([
                "ten_danh_muc"          => $request->ten_danh_muc,
                "slug_danh_muc"         => $request->slug_danh_muc,
                "tinh_trang"            => 1,
            ]);
            return response()->json([
                'status'        => true,
                'message'       => 'Đã thêm mới danh mục thành công!'
            ]);
        }
    }

    public function update(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            DanhMuc::where("id", $request->id)->update([
                "ten_danh_muc"          => $request->ten_danh_muc,
                "slug_danh_muc"         => $request->slug_danh_muc,
            ]);
            return response()->json([
                'status'        => true,
                'message'       => 'Đã cập nhật danh mục thành công!'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            DanhMuc::where("id", $request->id)->delete();

            return response()->json([
                'status'        => true,
                'message'       => 'Đã xóa danh mục thành công!'
            ]);
        }
    }

    public function changeStatus(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            $danh_muc = DanhMuc::where("id", $request->id)->first();
            if ($danh_muc) {
                $danh_muc->tinh_trang = !$danh_muc->tinh_trang;
                $danh_muc->save();
                return response()->json([
                    'status'        => true,
                ]);
            } else {
                return response()->json([
                    'status'        => false,
                    'message'       => 'Danh mục không tồn tại!'
                ]);
            }
        }
    }
}
