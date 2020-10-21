<?php

use Illuminate\Database\Seeder;

class AddBackUpUserClass extends Seeder
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
            ['name' => 'backup_123456', 'email'=>'backup@gmail.com', 'password' => Hash::make('123456')]
        ]);
    }
}
