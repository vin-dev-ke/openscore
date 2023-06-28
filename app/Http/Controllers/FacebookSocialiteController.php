<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;
use Exception;

class FacebookSocialiteController extends Controller
{
    public function redirectToFacebook ()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback ()
    {

        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('social_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('dashboard');
            } else {
                $newUser = User::updateOrCreate(
                    [
                        'email' => $user->email
                    ],
                    [
                        'name' => $user->name,
                        'social_id' => $user->id,
                        'social_type' => 'facebook',
                        'email_verified_at' => now(),
                        'password' => Hash::make($user->email)
                    ]
                );
                $role = Role::firstOrCreate(['name' => 'standard']);
                $newUser->assignRole($role->name);
                Auth::login($newUser);
                return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
             dd($e->getMessage());
        }
    }
}
