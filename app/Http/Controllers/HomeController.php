<?php

namespace App\Http\Controllers;

use App\Models\Scam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function PHPSTORM_META\type;

class HomeController extends Controller
{
    public function index ()
    {
        $role = Auth::user()->getRoleNames()->first();
        $users_count = User::all()->count();
        $scams_count = Scam::all()->count();

        if($role === 'admin') {
            return Inertia::render('AdminDash', [
                'users_count' => $users_count,
                'scams_count' => $scams_count,
            ]);
        } else {
            $user = Auth::user();
            return Inertia::render('UserDash', [
                'user' => $user,
            ]);
        }

    }
}
