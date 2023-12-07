<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'Administrator',
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now()
            ],
        ]);
    }
}
