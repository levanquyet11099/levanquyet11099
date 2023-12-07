<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
            array(
                'id' => '1',
                'account' => 'admin',
                'password' => bcrypt('12345678'),
                'full_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '12345678',
                'avatar' => NULL,
                'status' => '1',
                'remember_token' => 'mj3uTuIm9frFWZagAAt27eVc7pXI0b2Yox3UgnSdXJzlHO1iJ6rxhMDaDkBD',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )
        ]);
    }
}
