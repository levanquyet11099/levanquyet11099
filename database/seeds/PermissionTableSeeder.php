<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('permissions')->insert([
            array('id' => '1','name' => 'toan-bo-he-thong','display_name' => 'Toàn bộ hệ thống','description' => NULL,'group_permission_id' => '1','created_at' => '2019-10-09 11:38:19','updated_at' => '2019-10-09 11:38:19'),
            array('id' => '2','name' => 'danh-sach-loai-hang','display_name' => 'Danh sách loại hàng','description' => NULL,'group_permission_id' => '2','created_at' => '2019-10-09 11:38:57','updated_at' => '2019-10-09 11:38:57'),
            array('id' => '3','name' => 'them-moi-loai-hang','display_name' => 'Thêm mới loại hàng','description' => NULL,'group_permission_id' => '2','created_at' => '2019-10-09 11:39:21','updated_at' => '2019-10-09 11:39:21'),
            array('id' => '4','name' => 'chinh-sua-loai-hang','display_name' => 'Chỉnh sửa loại hàng','description' => NULL,'group_permission_id' => '2','created_at' => '2019-10-09 11:39:41','updated_at' => '2019-10-09 11:39:41'),
            array('id' => '5','name' => 'xoa-loai-hang','display_name' => 'Xóa loại hàng','description' => NULL,'group_permission_id' => '2','created_at' => '2019-10-09 11:39:55','updated_at' => '2019-10-09 11:39:55'),
            array('id' => '6','name' => 'danh-sach-don-vi-tinh','display_name' => 'Danh sách đơn vị tính','description' => NULL,'group_permission_id' => '3','created_at' => '2019-10-09 11:40:45','updated_at' => '2019-10-09 11:40:45'),
            array('id' => '7','name' => 'them-don-vi-tinh','display_name' => 'Thêm đơn vị tính','description' => NULL,'group_permission_id' => '3','created_at' => '2019-10-09 11:40:56','updated_at' => '2019-10-09 11:40:56'),
            array('id' => '8','name' => 'sua-don-vi-tinh','display_name' => 'Sửa đơn vị tính','description' => NULL,'group_permission_id' => '3','created_at' => '2019-10-09 11:41:37','updated_at' => '2019-10-09 11:41:37'),
            array('id' => '9','name' => 'xoa-don-vi-tinh','display_name' => 'Xóa đơn vị tính','description' => NULL,'group_permission_id' => '3','created_at' => '2019-10-09 11:41:49','updated_at' => '2019-10-09 11:41:49'),
            array('id' => '10','name' => 'danh-sach-san-pham','display_name' => 'Danh sách sản phẩm','description' => NULL,'group_permission_id' => '4','created_at' => '2019-10-09 11:52:20','updated_at' => '2019-10-09 11:52:20'),
            array('id' => '11','name' => 'them-san-pham','display_name' => 'Thêm sản phẩm','description' => NULL,'group_permission_id' => '4','created_at' => '2019-10-09 14:08:39','updated_at' => '2019-10-09 14:08:39'),
            array('id' => '12','name' => 'sua-san-pham','display_name' => 'Sửa sản phẩm','description' => NULL,'group_permission_id' => '4','created_at' => '2019-10-09 14:08:54','updated_at' => '2019-10-09 14:08:54'),
            array('id' => '13','name' => 'xoa-san-pham','display_name' => 'Xóa sản phẩm','description' => NULL,'group_permission_id' => '4','created_at' => '2019-10-09 14:09:06','updated_at' => '2019-10-09 14:09:06'),
            array('id' => '14','name' => 'danh-sach-nha-cung-cap','display_name' => 'Danh sách nhà cung cấp','description' => NULL,'group_permission_id' => '5','created_at' => '2019-10-09 14:10:14','updated_at' => '2019-10-09 14:10:14'),
            array('id' => '15','name' => 'them-nha-cung-cap','display_name' => 'Thêm nhà cung cấp','description' => NULL,'group_permission_id' => '5','created_at' => '2019-10-09 14:10:25','updated_at' => '2019-10-09 14:10:25'),
            array('id' => '16','name' => 'sua-nha-cung-cap','display_name' => 'Sửa nhà cung cấp','description' => NULL,'group_permission_id' => '5','created_at' => '2019-10-09 14:10:41','updated_at' => '2019-10-09 14:10:41'),
            array('id' => '17','name' => 'xoa-nha-cung-cap','display_name' => 'Xóa nhà cung cấp','description' => NULL,'group_permission_id' => '5','created_at' => '2019-10-09 14:11:12','updated_at' => '2019-10-09 14:11:12'),
            array('id' => '18','name' => 'danh-sach-nhap-hang','display_name' => 'Danh sách nhập hàng','description' => NULL,'group_permission_id' => '6','created_at' => '2019-10-09 14:12:36','updated_at' => '2019-10-09 14:13:20'),
            array('id' => '19','name' => 'them-don-nhap-hang','display_name' => 'Thêm đơn nhập hàng','description' => NULL,'group_permission_id' => '6','created_at' => '2019-10-09 14:13:50','updated_at' => '2019-10-09 14:14:33'),
            array('id' => '20','name' => 'sua-don-nhap-hang','display_name' => 'Sửa đơn nhập hàng','description' => NULL,'group_permission_id' => '6','created_at' => '2019-10-09 14:14:17','updated_at' => '2019-10-09 14:14:17'),
            array('id' => '21','name' => 'xoa-don-nhap-hang','display_name' => 'Xóa đơn nhập hàng','description' => NULL,'group_permission_id' => '6','created_at' => '2019-10-09 14:15:00','updated_at' => '2019-10-09 14:15:00'),
            array('id' => '22','name' => 'du-lieu-san-pham-nhap-hang','display_name' => 'Dữ liệu sản phẩm nhập hàng','description' => NULL,'group_permission_id' => '6','created_at' => '2019-10-09 14:16:18','updated_at' => '2019-10-09 14:16:18'),
            array('id' => '23','name' => 'danh-sach-xuat-hang','display_name' => 'Danh sách xuất hàng','description' => NULL,'group_permission_id' => '7','created_at' => '2019-10-09 14:17:36','updated_at' => '2019-10-09 14:17:36'),
            array('id' => '24','name' => 'them-don-xuat-hang','display_name' => 'Thêm đơn xuất hàng','description' => NULL,'group_permission_id' => '7','created_at' => '2019-10-09 14:17:52','updated_at' => '2019-10-09 14:17:52'),
            array('id' => '25','name' => 'sua-don-xuat-hang','display_name' => 'Sửa đơn xuất hàng','description' => NULL,'group_permission_id' => '7','created_at' => '2019-10-09 14:18:08','updated_at' => '2019-10-09 14:18:08'),
            array('id' => '26','name' => 'xoa-don-xuat-hang','display_name' => 'Xóa đơn xuất hàng','description' => NULL,'group_permission_id' => '7','created_at' => '2019-10-09 14:18:38','updated_at' => '2019-10-09 14:18:38'),
            array('id' => '27','name' => 'du-lieu-san-pham-xuat-hang','display_name' => 'Dữ liệu sản phẩm xuất hàng','description' => NULL,'group_permission_id' => '7','created_at' => '2019-10-09 14:19:51','updated_at' => '2019-10-09 14:19:51'),
            array('id' => '28','name' => 'du-lieu-kho-hang','display_name' => 'Dữ liệu kho hàng','description' => NULL,'group_permission_id' => '8','created_at' => '2019-10-09 14:20:52','updated_at' => '2019-10-09 14:20:52'),
            array('id' => '29','name' => 'danh-sach-quan-tri-vien','display_name' => 'Danh sách quản trị viên','description' => NULL,'group_permission_id' => '9','created_at' => '2019-10-09 14:22:20','updated_at' => '2019-10-09 14:22:20'),
            array('id' => '30','name' => 'them-moi-quan-tri-vien','display_name' => 'Thêm mới quản trị viên','description' => NULL,'group_permission_id' => '9','created_at' => '2019-10-09 14:22:29','updated_at' => '2019-10-09 14:22:29'),
            array('id' => '31','name' => 'sua-quan-tri-vien','display_name' => 'Sửa quản trị viên','description' => NULL,'group_permission_id' => '9','created_at' => '2019-10-09 14:22:49','updated_at' => '2019-10-09 14:22:49'),
            array('id' => '32','name' => 'xoa-quan-tri-vien','display_name' => 'Xóa quản trị viên','description' => NULL,'group_permission_id' => '9','created_at' => '2019-10-09 14:24:27','updated_at' => '2019-10-09 14:24:27'),
            array('id' => '33','name' => 'danh-sach-vai-tro-thanh-vien','display_name' => 'Danh sách vai trò thành viên','description' => NULL,'group_permission_id' => '10','created_at' => '2019-10-09 14:25:46','updated_at' => '2019-10-09 14:25:46'),
            array('id' => '34','name' => 'them-vai-tro-thanh-vien','display_name' => 'Thêm vài trò thành viên','description' => NULL,'group_permission_id' => '10','created_at' => '2019-10-09 14:30:32','updated_at' => '2019-10-09 14:30:32'),
            array('id' => '35','name' => 'sua-vai-tro-thanh-vien','display_name' => 'Sửa vai trò thành viên','description' => NULL,'group_permission_id' => '10','created_at' => '2019-10-09 14:30:43','updated_at' => '2019-10-09 14:30:43'),
            array('id' => '36','name' => 'xoa-vai-tro-thanh-vien','display_name' => 'Xóa vai trò thành viên','description' => NULL,'group_permission_id' => '10','created_at' => '2019-10-09 14:30:56','updated_at' => '2019-10-09 14:30:56')
        ]);
    }
}
