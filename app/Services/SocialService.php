<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Contracts\User as SocialUser;

class SocialService implements Contracts\Social
{

    /**
     * @param SocialUser $socialUser
     * @return string
     * @throws \Exception
     */
    public function loginAndGetRedirectUrl(SocialUser $socialUser): string
{
    $user = User::query()->where('email', '=', $socialUser->getEmail())->first();
    if ($user === null) {
        //register
        return route('register');
    }
    $user->name = $socialUser->getName();
    $user->avatar = $socialUser->getAvatar();
    if($user->save()) {
        Auth::loginUsingId($user->id);
        return route('account');
    }
    throw new \Exception('User has not saved');
}
}
