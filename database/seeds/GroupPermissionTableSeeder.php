<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GroupPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('group_permission')->insert([
            array('id' => '1','name' => 'Toàn bộ hệ thống','description' => 'Toàn bộ quyền quản lý hệ thống','created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '2','name' => 'Quản lý loại hàng','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '3','name' => 'Quản lý đơn vị tính','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '4','name' => 'Quản lý sản phẩm','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '5','name' => 'Quản lý nhà cung cấp','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '6','name' => 'Quản lý dữ liệu nhập hàng','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '7','name' => 'Quản lý dữ liệu xuất hàng','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '8','name' => 'Quản lý dữ liệu kho hàng','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '9','name' => 'Quản lý quản trị viên','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now()),
            array('id' => '10','name' => 'Quản lý vai trò thành viên','description' => NULL,'created_at' =>  Carbon::now(),'updated_at' =>  Carbon::now())
        ]);
    }
}
