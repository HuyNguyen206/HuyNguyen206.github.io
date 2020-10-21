<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\Setting;
use App\Traits\DeleteModelTrait;
use App\Traits\UploadImageTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;


class AdminUserController extends Controller
{

   use DeleteModelTrait;
    function getListUser()
    {
        $users = User::latest()->get();
        return view('backend.pages.user.list', compact('users'));
    }

    function getFormUser()
    {
        $roles = Role::all();
        return view('backend.pages.user.add', compact('roles'));
    }

    function postFormUser(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $user= new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->roles()->attach($request->roles);
            DB::commit();
            return redirect()->back()->with('message', 'Tạo user thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }

    }

    function getEditUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('backend/pages/user/edit', compact('user', 'roles'));

    }

    function postEditUser(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->sync($request->roles);
            DB::commit();
            return redirect()->back()->with('message', 'Chỉnh sửa user thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteUser($id)
    {
        User::find($id)->roles()->detach();
        return $this->delete(new User(), $id, false,"");
    }

}
