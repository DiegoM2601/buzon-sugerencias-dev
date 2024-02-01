<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        // return Socialite::driver('google')->redirect();
        return Socialite::driver('google')
            ->with(["hd" => "unifranz.edu.bo"]) // Filtrar por dominio
            // ->with(["prompt" => "select_account"]) // Mostrar una lista de cuentas disponibles
            ->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $allowedDomain = 'unifranz.edu.bo'; // Dominio permitido sin "@"
        $email = $googleUser->email;

        $nameBranches = array("cbbe", "scze", "eate", "lpze", "doc");

        $initialEmail = explode('.', $googleUser->getEmail());

        if(in_array($initialEmail[0], $nameBranches)){
            return redirect()->route('login')->with('error','Usuario no autorizado');
        }

        $user = User::where('email', $googleUser->email)->first();

        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999))]);
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
