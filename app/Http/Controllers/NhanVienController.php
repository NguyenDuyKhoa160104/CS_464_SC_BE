<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhanVienController extends Controller
{

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
                'message'   =>  'Bạn cần đăng nhập hệ thống trước'
            ]);
        }
    }

    public function getDataDangNhap()
    {
        $login = Auth::guard('sanctum')->user();

        return response()->json([
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
            return response()->json([
                'status'  => true,
            ]);
        } else {
            return response()->json([
                'status'  => false,
            ]);
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
                    'token'   => $nhanVien->createToken('token_nhan_vien')->plainTextToken,
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
}
