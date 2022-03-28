<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{

    public function redirectToProvider(){
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback(){
        $user = Socialite::driver('google')->user();
    
        $user = User::firstOrCreate([
            'email' => $user->email
        ],[
            'name' => $user->name,
            'password' => hash('sha256',Str::random(32)),
            'email' => $user->email,
        ]);

        Auth::login($user,true);

        return redirect( route('index'));
    }
}
