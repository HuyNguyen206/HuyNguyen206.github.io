<?php
namespace App\Helpers;

use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\LinkedSocialAccount;
class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser, $provider)
    {
        $account = LinkedSocialAccount::where('provider_name', $provider)
            ->where('provider_id', $providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
                $user->roles()->attach(4);
            }

            $user->socialAccounts()->create([
                'provider_id' => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;

        }
    }

}
