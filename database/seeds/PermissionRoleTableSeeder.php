<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('permission_role')->insert([
            array('permission_id' => '1','role_id' => '1')
        ]);
    }
}
