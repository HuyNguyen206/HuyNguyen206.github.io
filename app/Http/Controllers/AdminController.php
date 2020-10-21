<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    function index()
    {
        return view('backend.pages.main-page');
    }
    function GetFormlogin()
    {
        if(Auth::check())
        {
            return redirect()->back();
        }
        else
        {
            return view('backend.pages.login');
        }

    }
    function PostFormlogin (Request $request)
    {
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'password.required' => 'Vui lòng nhập password'
    ]);
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password], isset($request->remember_me) ? true : false))
        {
            return redirect('admin');
        }
        else
        {
            return redirect()->back()->with('message', 'Email hoặc password không hợp lệ');
        }
    }

    function Logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
