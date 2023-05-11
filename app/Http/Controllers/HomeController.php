<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
<<<<<<< HEAD
use App\Models\Scam;
=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
=======
use App\Models\Scam;
>>>>>>> 4494bb2 (Add users and scams sections for admin)
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

<<<<<<< HEAD
<<<<<<< HEAD
use function PHPSTORM_META\type;

=======
>>>>>>> 45b0c05 (Set up google auth and auth screens)
=======
use function PHPSTORM_META\type;

>>>>>>> 4494bb2 (Add users and scams sections for admin)
class HomeController extends Controller
{
    public function index ()
    {
        $role = Auth::user()->getRoleNames()->first();
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
        $users_count = User::all()->count();
        $scams_count = Scam::all()->count();

        if($role === 'admin') {
            return Inertia::render('AdminDash', [
                'users_count' => $users_count,
                'scams_count' => $scams_count,
            ]);
        } else {
<<<<<<< HEAD
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
=======
            return Inertia::render('UserDash');
        }

>>>>>>> 4494bb2 (Add users and scams sections for admin)
    }
}
