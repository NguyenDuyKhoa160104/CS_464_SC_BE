<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_viens')->delete();

        DB::table('nhan_viens')->truncate();
        
        DB::table('nhan_viens')->insert([
            [
                'email'             =>  'nguyenduykhoa16012004@gmail.com',
                'password'          =>  bcrypt('1234567'),
                'ten_nhan_vien'     =>  'Nguyễn Duy Khoa',
                'so_dien_thoai'     =>  '0905.523.543',
                'hinh_anh'          =>  'https://th.bing.com/th/id/OIP.beU7olu_VHdPxDC7jPP9gQHaHa?r=0&o=7rm=3&rs=1&pid=ImgDetMain&cb=idpwebpc2',
                'tinh_trang'        =>  1,
                'id_quyen'          =>  1,
            ],
            [
                'email'             =>  'nguyenngocoanhthu02112004@gmail.com',
                'password'          =>  bcrypt('1234568'),
                'ten_nhan_vien'     =>  'Nguyễn Ngọc Oanh Thư',
                'so_dien_thoai'     =>  '03.888.24.999',
                'hinh_anh'          =>  'https://khoinguonsangtao.vn/wp-content/uploads/2022/08/avatar-nu-dep.jpg',
                'tinh_trang'        =>  1,
                'id_quyen'          =>  2,
            ],
        ]);
    }
}
