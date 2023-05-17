<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Scam;
=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

<<<<<<< HEAD
use function PHPSTORM_META\type;

=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
class HomeController extends Controller
{
    public function index ()
    {
        $role = Auth::user()->getRoleNames()->first();
<<<<<<< HEAD
        $users_count = User::all()->count();
        $scams_count = Scam::all()->count();

        if($role === 'admin') {
            return Inertia::render('AdminDash', [
                'users_count' => $users_count,
                'scams_count' => $scams_count,
            ]);
        } else {
            $user = Auth::user();
            $scams = Scam::withTrashed()->with('user')->paginate(3);
            
            return Inertia::render('UserDash', [
                'user' => $user,
                'scams' => $scams
            ]);
        }

=======
        return Inertia::render('Dashboard', [
            'role'=>$role
        ]);
>>>>>>> 45b0c05 (Set up google auth and auth screens)
    }
}
