<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            ['name' => 'SuperAdmin', 'display_name' => 'Siêu quản trị'],
            ['name' => 'Admin', 'display_name' => 'Quản trị'],
            ['name' => 'Member', 'display_name' => 'Thành viên thông thường'],
            ['name' => 'Guest', 'display_name' => 'Khách']
        ]);
    }
}
