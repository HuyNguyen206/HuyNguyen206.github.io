<?php

namespace App\Http\Controllers\FrontEnd;

use App\City;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegisterRequest;
use App\User;
use http\Url;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function login()
    {
        if(!\Auth::check())
        {
            $cities = City::all();
            return view('frontend.login.user-login-register', compact('cities'));
        }
        return redirect('/');

    }

    function userRegister(CustomerRegisterRequest $request)
    {
        try {
            \DB::beginTransaction();
            //Assign Guest role for customer when they sign in
            $user= new User();
            $user->name = $request->name;
            $user->email = $request->email_register;
            $user->password = bcrypt($request->password_register);
            $user->save();
            $user->roles()->attach(4);


            $customer = new Customer();
            $customer->user_id =$user->id;
            $customer->address =$request->address;
            $customer->postal_code =$request->{'postal-code'};
            $customer->city_id =$request->city;
            $customer->district_id =$request->district;
            $customer->phone =$request->phone;

            $customer->save();
            \DB::commit();
            \Auth::attempt(['email' => $request->email_register, 'password' => $request->password_register], true);
            $user->sendEmailVerificationNotification();
            return view('auth.verify');
        }
        catch (\Exception $ex)
        {
            \DB::rollBack();
            return redirect()->back()->with('message',$ex->getMessage());
        }

    }

    function userSignIn(Request $request)
    {
        $request->validate(
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $loginCredential = ['email' => $request->email, 'password' => $request->password];
        if(\Auth::attempt($loginCredential, isset($request->remember) ? true :false))
        {
            return redirect('/');
//            return redirect()->back();
        }
        else
        {
            return redirect()->back()->with('message','Email or Password is incorrect!');
        }
    }

    function logout()
    {
         \Auth::logout();
         return redirect()->back();
    }

    function getDistrictById($id)
    {
        try {
            $district = City::find($id)->districts;
            $districtHtml = "<option>-- District --</option>";
            foreach ($district as $d)
            {
                $districtHtml.="<option value='".$d->id."'>".$d->name."</option>";
            }
            return response()->json(['code' => 200, 'data' => $districtHtml], 200);
        }
        catch (\Exception $ex)
        {
            return response()->json(['code' => 500, 'data' => $districtHtml, 'message' => $ex->getMessage()], 500);
        }

    }
}
