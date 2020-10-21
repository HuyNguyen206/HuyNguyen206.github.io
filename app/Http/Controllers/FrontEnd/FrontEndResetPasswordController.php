<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassRequest;
use App\Http\Requests\SendMailRequest;
use App\Notifications\SendEmailResetPass;
use App\PasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FrontEndResetPasswordController extends Controller
{
    //
    function sendEmail(SendMailRequest $request)
    {
        //Create Password Reset Token
        $token  = Str::random(64);
        PasswordReset::updateOrCreate(['email' => $request->email], ['token' => Hash::make($token), 'created_at' =>  Carbon::now()]);
//        $passwordReset = new PasswordReset();
//        $passwordReset->email = $request->email;
//        $token  = Str::random(64);
//        $passwordReset->token =  Hash::make($token);
//        $passwordReset->created_at = Carbon::now();
//        $passwordReset->save();
//        dd('test');
        $result = $this->sendResetEmail($request->email, $token);
        if ($result['isSuccess']) {
//            dd($token);
            return redirect()->back()->with(['message' => 'A reset link has been sent to your email address.', 'isSuccess' => $result['isSuccess']]);
        } else {
            return redirect()->back()->with(['message' =>  $result['message'], 'isSuccess' => $result['isSuccess']]);
        }
    }

    private function sendResetEmail($email, $token)
    {
        //Generate, the password reset link. The token generated is embedded in the link
        $link = URL::to('/') . '/password/reset/' . $token . '?email=' .  urlencode($email);
        try {
            //Here send the link with CURL with an external email API
            $user= User::where('email', $email)->first();
            $data['name'] = $user->name;
            $data['reset-link'] =  $link;
            $user->notify(new SendEmailResetPass($data));
            $result['isSuccess'] = true;
            return $result;
        } catch (\Exception $e) {
//            dd($e->getMessage());
            $result['isSuccess'] = false;
            $result['message'] = $e->getMessage();
            return $result;
        }
    }

    function passwordReset(ResetPassRequest $request)
    {
        try {
            \DB::beginTransaction();
//            dump($request->token);
//            dd(bcrypt($request->token));
            $passReset = PasswordReset::where('email', urldecode($request->email))->first();
//            dump(bcrypt($request->token));
//            dd($isValidLink);
            if (!$passReset || !Hash::check($request->token, $passReset->token))
            {
                return redirect()->back()->with(['message' => 'The reset link is invalid', 'isSuccess' => false]);
            }
            if(Carbon::now()->diffInMinutes($passReset->created_at) > 60)
            {
                return redirect()->back()->with(['message' => 'The reset link is expired', 'isSuccess' => false]);
            }

            $user = User::where('email', $request->email)->first();
            $user->password = \Hash::make($request->password);
            $user->save();

            $passReset->delete();
            \Auth::login($user);
            \DB::commit();
            return view('auth.passwords.reset-success', ['message' => 'Your password has been reset successfully!']);
        }
        catch (\Exception $ex)
        {
            \DB::rollBack();
            return redirect()->back()->with(['message' => $ex->getMessage(), 'isSuccess' => false]);
        }

    }
}
