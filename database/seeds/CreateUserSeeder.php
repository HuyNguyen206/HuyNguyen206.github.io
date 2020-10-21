<?php

use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['name' => 'huy', 'email' => 'huynl@yahoo.com', 'password'=>bcrypt('123456')],
            ['name' => 'hoang', 'email' => 'hoangtn@yahoo.com', 'password'=>bcrypt('123456')],
            ['name' => 'nam', 'email' => 'namhv@yahoo.com', 'password'=>bcrypt('123456')]
        ]);
    }
}
