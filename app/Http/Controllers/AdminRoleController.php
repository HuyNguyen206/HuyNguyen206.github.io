<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Permission;
use App\Role;
use App\Slider;
use Illuminate\Http\Request;
use Mockery\Exception;
use Illuminate\Support\Facades\DB;
use App\Traits\DeleteModelTrait;

class AdminRoleController extends Controller
{
    use DeleteModelTrait;
    function getListRole()
    {
        $roles = Role::latest()->get();
//        dump($products);die;
        return view('backend.pages.role.list', compact('roles'));
    }

    function getFormRole()
    {
//        $permissions = Permission::all();
        $parentPermissions = Permission::where('parent_id', 0)->get();
//        foreach ($parentPermissions as $parent)
//        {
//            $permissionArray[$parent->id] = $parent;
//            $permissionArray[$parent->id]['child'] = $permissions->filter(function($value, $key) use($parent){
//                return $value['parent_id'] == $parent->id;
//        });
//        }
//        dd($permissionArray);
//        return view('backend.pages.role.add', compact('permissionArray'));
        return view('backend.pages.role.add', compact('parentPermissions'));
    }

    function postFormRole(CreateRoleRequest $request)
    {
//        dd($request->all());
        try {
            DB::beginTransaction();
            $role= new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->save();
            $role->permissions()->attach($request->permission);
            DB::commit();
            return redirect()->back()->with('message', 'Tạo Role thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }

    }

    function getEditRole($id)
    {
        $parentPermissions = Permission::where('parent_id', 0)->get();
        $role = Role::find($id);
        return view('backend/pages/role/edit', compact('parentPermissions', 'role'));

    }

    function postEditRole(UpdateRoleRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->save();
            $role->permissions()->sync($request->permission);
            DB::commit();
            return redirect()->back()->with('message', 'Chỉnh sửa role thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteRole($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->permissions()->detach();
            $role->users()->detach();
            $role->delete();
            DB::commit();
            return response()->json(['code' => 200, 'message'=> 'Success'], 200);
        }
        catch(\Exception $ex)
        {
         DB::rollBack();
         return response()->json(['code' => 500, 'message'=> $ex->getMessage()], 500);
        }


    }
}
