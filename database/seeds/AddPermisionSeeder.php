<?php

use Illuminate\Database\Seeder;

class AddPermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->insert([
            ['id'=>1, 'name'=>'Category', 'display_name'=>'Category', 'parent_id' => 0],
            ['id'=>2, 'name'=>'Danh sách Category', 'display_name'=>'Danh sách Category', 'parent_id' => 1],
            ['id'=>3, 'name'=>'Thêm category', 'display_name'=>'Thêm category', 'parent_id' => 1],
            ['id'=>4, 'name'=>'Sửa Category', 'display_name'=>'Sửa Category', 'parent_id' => 1],
            ['id'=>5, 'name'=>'Xóa Category', 'display_name'=>'Xóa Category', 'parent_id' => 1],

            ['id'=>6, 'name'=>'Menu', 'display_name'=>'Menu', 'parent_id' => 0],
            ['id'=>7, 'name'=>'Danh sách Menu', 'display_name'=>'Danh sách Menu', 'parent_id' => 6],
            ['id'=>8, 'name'=>'Thêm Menu', 'display_name'=>'Thêm Menu', 'parent_id' => 6],
            ['id'=>9, 'name'=>'Sửa Menu', 'display_name'=>'Sửa Menu', 'parent_id' => 6],
            ['id'=>10, 'name'=>'Xóa Menu', 'display_name'=>'Xóa Menu', 'parent_id' => 6],

            ['id'=>11, 'name'=>'Sản phẩm', 'display_name'=>'Sản phẩm', 'parent_id' => 0],
            ['id'=>12, 'name'=>'Danh sách Sản phẩm', 'display_name'=>'Danh sách Sản phẩm', 'parent_id' => 11],
            ['id'=>13, 'name'=>'Thêm Sản phẩm', 'display_name'=>'Thêm Sản phẩm', 'parent_id' => 11],
            ['id'=>14, 'name'=>'Sửa Sản phẩm', 'display_name'=>'Sửa Sản phẩm', 'parent_id' => 11],
            ['id'=>15, 'name'=>'Xóa Sản phẩm', 'display_name'=>'Xóa Sản phẩm', 'parent_id' => 11],

            ['id'=>16, 'name'=>'Slider', 'display_name'=>'Slider', 'parent_id' => 0],
            ['id'=>17, 'name'=>'Danh sách Slider', 'display_name'=>'Danh sách Slider', 'parent_id' => 16],
            ['id'=>18, 'name'=>'Thêm Slider', 'display_name'=>'Thêm Slider', 'parent_id' => 16],
            ['id'=>19, 'name'=>'Sửa Slider', 'display_name'=>'Sửa Slider', 'parent_id' => 16],
            ['id'=>20, 'name'=>'Xóa Slider', 'display_name'=>'Xóa Slider', 'parent_id' => 16],

            ['id'=>21, 'name'=>'Setting', 'display_name'=>'Setting', 'parent_id' => 0],
            ['id'=>22, 'name'=>'Danh sách Setting', 'display_name'=>'Danh sách Setting', 'parent_id' => 21],
            ['id'=>23, 'name'=>'Thêm Setting', 'display_name'=>'Thêm Setting', 'parent_id' => 21],
            ['id'=>24, 'name'=>'Sửa Setting', 'display_name'=>'Sửa Setting', 'parent_id' => 21],
            ['id'=>25, 'name'=>'Xóa Setting', 'display_name'=>'Xóa Setting', 'parent_id' => 21],

            ['id'=>26, 'name'=>'Users', 'display_name'=>'Users', 'parent_id' => 0],
            ['id'=>27, 'name'=>'Danh sách Users', 'display_name'=>'Danh sách Users', 'parent_id' => 26],
            ['id'=>28, 'name'=>'Thêm Users', 'display_name'=>'Thêm Users', 'parent_id' => 26],
            ['id'=>29, 'name'=>'Sửa Users', 'display_name'=>'Sửa Users', 'parent_id' => 26],
            ['id'=>30, 'name'=>'Xóa Users', 'display_name'=>'Xóa Users', 'parent_id' => 26],

            ['id'=>31, 'name'=>'Roles', 'display_name'=>'Roles', 'parent_id' => 0],
            ['id'=>32, 'name'=>'Danh sách Roles', 'display_name'=>'Danh sách Roles', 'parent_id' => 31],
            ['id'=>33, 'name'=>'Thêm Roles', 'display_name'=>'Thêm Roles', 'parent_id' => 31],
            ['id'=>34, 'name'=>'Sửa Roles', 'display_name'=>'Sửa Roles', 'parent_id' => 31],
            ['id'=>35, 'name'=>'Xóa Roles', 'display_name'=>'Xóa Roles', 'parent_id' => 31],


        ]);
    }
}
