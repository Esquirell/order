<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect(url()->previous());
    }

    public function findOrCreateUser($user, $provider)
    {
        if (Auth::user()) {
            Auth::user()->update([
                "{$provider}_id" => $user->id
            ]);
            redirect('/home');
        }

        $authUser = User::where("{$provider}_id", $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'     => $user->nickname ?? $user->name,
            'email'    => $user->email,
            "{$provider}_id" => $user->id
        ]);
    }

}
