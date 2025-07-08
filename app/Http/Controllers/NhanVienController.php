<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhanVienController extends Controller
{
    public function changeStatus(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang) {
                if ($login->id_quyen == 1) {
                    $nhan_vien = NhanVien::where("id", $request->id)->first();
                    if ($nhan_vien) {
                        $nhan_vien->tinh_trang = !$nhan_vien->tinh_trang;
                        $nhan_vien->save();
                        return response()->json([
                            'status'  => true,
                        ]);
                    } else {
                        return response()->json([
                            'status'  => false,
                            'message'       => 'Nhân viên không tồn tại!'
                        ]);
                    }
                } else {
                    return response()->json([
                        'status'  => false,
                        'message'       => 'Bạn không có quyền đổi tình trạng nhân viên!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message'       => 'Tài khoản của bạn đang tạm khóa!'
                ]);
            }
        }
    }

    public function kiemTraAdmin()
    {
        $login = Auth::guard('sanctum')->user();

        if ($login && $login instanceof \App\Models\NhanVien) {
            return response()->json([
                'status'    =>  true
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn cần đăng nhập hệ thống trước!'
            ]);
        }
    }

    public function getDataDangNhap()
    {
        $login = Auth::guard('sanctum')->user();

        return response()->json([
            'status'  => true,
            'data'    =>  $login
        ]);
    }

    public function getData()
    {
        $data = NhanVien::get();

        return response()->json([
            'data'  => $data,
        ]);
    }

    public function store(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                if ($login->id_quyen == 1) {
                    NhanVien::create([
                        "email"             => $request->email,
                        "password"          => bcrypt($request->password),
                        "ten_nhan_vien"     => $request->ten_nhan_vien,
                        "so_dien_thoai"     => $request->so_dien_thoai,
                        "hinh_anh"          => "",
                        "tinh_trang"        => 1,
                        "id_quyen"          => $request->id_quyen,
                    ]);
                    return response()->json([
                        'status'  => true,
                        'message'       => 'Đã thêm mới nhân viên thành công!'
                    ]);
                } else {
                    return response()->json([
                        'status'  => false,
                        'message'       => 'Bạn không có quyền thêm nhân viên!'
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message'       => 'Tài khoản của bạn đang tạm khóa!'
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $login = Auth::guard('sanctum')->user();
        if ($login) {
            if ($login->tinh_trang == 1) {
                NhanVien::where("id", $request->id)->update([
                    "email"                 => $request->email,
                    "ten_nhan_vien"         => $request->ten_nhan_vien,
                    "so_dien_thoai"         => $request->so_dien_thoai,
                ]);

                return response()->json([
                    'status'    => true,
                    'message'   => "Đã cập nhật nhân viên thành công!"
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => "Tài khoản của bạn đang tạm khóa!"
                ]);
            }
        }
    }

    public function login(Request $request)
    {
        try {
            $check  = Auth::guard('nhanvien')->attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ]);

            if ($check) {
                $nhanVien = Auth::guard('nhanvien')->user();

                return response()->json([
                    'status'  => true,
                    'message' => "Đã đăng nhập thành công!",
                    'token_nhan_vien'   => $nhanVien->createToken('token_nhan_vien')->plainTextToken,
                    'ten_nv'  => $nhanVien->ten_nhan_vien,
                    'anh_nv'  => $nhanVien->hinh_anh,
                    'quyen_nv' => $nhanVien->id_quyen,
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => "Tài khoản hoặc mật khẩu không đúng!",
                ]);
            }
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Đăng nhập thất bại. Lỗi hệ thống!',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

        public function logout()
        {
            $login = Auth::guard('sanctum')->user();
            if ($login && $login instanceof \App\Models\NhanVien) {
                DB::table('personal_access_tokens')
                    ->where('id', $login->currentAccessToken()->id)->delete();
                return response()->json([
                    'status' => true,
                    'message' => "Bạn đã đăng xuất thành công!"
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Bạn chưa đăng nhập hệ thống!"
                ]);
            }
        }

    public function logoutAll()
    {
        $login = Auth::guard('sanctum')->user();
        if ($login && $login instanceof \App\Models\NhanVien) {
            $ds_token = $login->tokens;
            foreach ($ds_token as $key => $value) {
                $value->delete();
            }
            return response()->json([
                'status' => true,
                'message' => "Bạn đã đăng xuất thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "bạn chưa đăng nhập hệ thống!"
            ]);
        }
    }
}
