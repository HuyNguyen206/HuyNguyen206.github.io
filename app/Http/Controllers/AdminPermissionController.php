<?php

namespace App\Http\Controllers;

use App\Components\ModelRecursive;
use App\Http\Requests\CreateBootstrapPermissionRequest;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Menu;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPermissionController extends Controller
{
//    private $menu;
//    public function __construct(Menu $menu)
//    {
//        $this->menu = $menu;
//    }

    function getListPermission()
    {
//        $menus = $this->menu->all();
        $permissions = Permission::all();
        return view('backend.pages.permission.list', compact('permissions'));
    }
    function getFormPermission()
    {
        $recursive = new ModelRecursive();
        $htmlSelectData = $recursive->modelRecursive(0, '', new Permission());
        return view('backend.pages.permission.add', compact('htmlSelectData'));
    }

    function postFormPermission(CreatePermissionRequest $request)
    {
        try {
            $permisison = new Permission();
            $permisison->name = $request->name;
            $permisison->display_name = $request->display_name;
            $permisison->parent_id = $request->parent_id;
            $permisison->key_code = $request->key_code;
            $permisison->save();
            return redirect()->back()->with(['message' => 'Tạo ' .$request->parent_module.' thành công', 'isSuccess' =>  true]);
        }
        catch (\Exception $ex)
        {
            DB::rollback();
            return redirect()->back()->with(['message' => $ex->getMessage(), 'isSuccess' =>  false]);

        }

    }

    function getEditPermission($id)
    {
        $permission = Permission::find($id);
        $recursive = new ModelRecursive();
        $htmlSelectData = $recursive->modelRecursiveWithSelected($permission->parent_id,0, '', new Permission());
        return view('backend.pages.permission.edit', compact('permission', 'htmlSelectData'));
    }
    function postEditPermission(UpdatePermissionRequest $request, $id)
    {
        try {
            $permision = Permission::find($id);
            $permision->name = $request->name;
            $permision->display_name = $request->display_name;
            $permision->parent_id = $request->parent_id;
            $permision->key_code = $request->key_code;
            $permision->save();
            return redirect()->back()->with('message', 'Sửa permission thành công');
        }
        catch (\Exception $ex)
        {
            return redirect()->back()->with('message', $ex->getMessage());
        }

    }

    function deletePermission($id)
    {
        try {
            DB::beginTransaction();
            $permission = Permission::find($id);
            $permission->delete();
            $permission->roles()->detach();
            DB::commit();
            return response()->json(['code' => 200, 'message' => 'success' ], 200);
        }
        catch (\Exception $ex)
        {
            DB::rollBack();
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
        }

    }


    function getFormBootstrapPermission()
    {
        return view('backend.pages.permission.bootstrap');
    }

    function postFormBootstrapPermission(CreateBootstrapPermissionRequest $request)
    {
        try {
            DB::beginTransaction();
            $permisison = new Permission();
            $permisison->name = $request->parent_module;
            $permisison->display_name = $request->parent_module;
            $permisison->save();
            foreach ($request->permission as $value)
            {
                Permission::create([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $permisison->id,
                    'key_code' => $value.'_'. $request->parent_module

                ]);
            }
            DB::commit();
            return redirect()->back()->with(['message' => 'Tạo ' .$request->parent_module.' thành công', 'isSuccess' =>  true]);
        }
        catch (\Exception $ex)
        {
            DB::rollback();
            return redirect()->back()->with(['message' => $ex->getMessage(), 'isSuccess' =>  false]);

        }

    }


}
