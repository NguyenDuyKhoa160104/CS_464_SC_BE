<?php

namespace App\Http\Controllers;

use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HoaDonController extends Controller
{
    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if (!$login) {
            return response()->json([
                'status' => false,
                'message' => 'Bạn chưa đăng nhập!'
            ]);
        }

        if ($login->tinh_trang != 1) {
            return response()->json([
                'status' => false,
                'message' => 'Tài khoản của bạn đang tạm khóa!'
            ]);
        }

        try {
            DB::beginTransaction();

            $hoa_don = HoaDon::create([
                'ma_hoa_don'     => 'HD' . strtoupper(Str::random(6)),
                'ten_khach_hang' => $request->ten_khach_hang,
                'so_dien_thoai'  => $request->so_dien_thoai,
                'tong_tien'      => $request->tong_tien,
                'tinh_trang'     => 1,
            ]);

            foreach ($request->chi_tiet as $ct) {
                ChiTietHoaDon::create([
                    'id_hoa_don'   => $hoa_don->id,
                    'id_san_pham'  => $ct['id_san_pham'],
                    'so_luong'     => $ct['so_luong'],
                    'don_gia'      => $ct['don_gia'],
                ]);
            }

            KhachHang::create([
                'ten_khach_hang' => $request->ten_khach_hang,
                'so_dien_thoai'  => $request->so_dien_thoai,
                'email'          => "",
                'tinh_trang'     => 1,
            ]);

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Tạo hóa đơn thành công!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Lỗi server: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData(Request $request)
    {

        $hoa_don_list = HoaDon::with(['chiTiet.sanPham'])
            ->orderBy('created_at', 'desc')
            ->get(); // lấy toàn bộ dữ liệu, không phân trang

        return response()->json([
            'status' => true,
            'message' => 'Lấy danh sách hóa đơn thành công!',
            'data' => $hoa_don_list
        ]);
    }

    public function changeStatus(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                $hoa_don = HoaDon::where("id", $request->id)->first();
                if ($hoa_don) {
                    $hoa_don->tinh_trang = !$hoa_don->tinh_trang;
                    $hoa_don->save();
                    return response()->json(['status' => true,]);
                } else {
                    return response()->json(['status' => false, 'message' => "Khách hàng không tồn tại!"]);
                }
            } else {
                return response()->json(['status' => false, 'message' => "Tài khoản của bạn đang tạm khóa!"]);
            }
        }
    }
}
