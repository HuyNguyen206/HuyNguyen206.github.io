<?php

namespace App\Http\Controllers\FrontEnd;

use App\Helpers\SocialAccountService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAccountController extends Controller
{
    //
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
//        dd($provider);
        return \Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(SocialAccountService $accountService, $provider)
    {
//        dd($provider);
        try {
            $user = \Socialite::with($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        try {
            \DB::beginTransaction();
            $authUser = $accountService->findOrCreate(
                $user,
                $provider
            );

            auth()->login($authUser, true);
            \DB::commit();
//            return redirect()->to('/home');
            return view('frontend.login.close-popup-social');
        }
        catch(\Exception $ex)
        {
            \DB::rollBack();
            dd($ex->getMessage());
        }

    }
}
