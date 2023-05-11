<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Scam;
=======
>>>>>>> 4494bb2 (Add users and scams sections for admin)
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //All users
<<<<<<< HEAD
    public function index (Request $request)
=======
    public function index ()
>>>>>>> 4494bb2 (Add users and scams sections for admin)
    {
        $role = Auth::user()->roles[0]->first();

        try {
            // Check if the current user is an admin
            if (!$role === 'admin') {
                throw new \Exception('Access denied.');
            }
    
            // If the user is an admin, show the users page
<<<<<<< HEAD
            $users = User::withTrashed()
                ->when($request->search_term, function($query,$search_term){$query->where('name', 'LIKE','%'.$search_term.'%');})
                ->paginate(2);
            
            return Inertia::render('Users', [
                'users' => $users,
            ]);
            
=======
            $users = User::withTrashed()->paginate(2);
            return Inertia::render('Users', [
                'users' => $users
            ]);
>>>>>>> 4494bb2 (Add users and scams sections for admin)
        } catch (\Exception $e) {

            // If an exception is thrown, redirect the user to the home page
            return Inertia::render('Dashboard')->with('error', $e->getMessage());
        }
    }

    //Show user
    public function show (User $user)
    {
        //
    }


    //Delete user
    public function destroy(User $user) 
    {
        $user->delete();
        return to_route('users.index');
    }

    //Restore user
    public function restore (int $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return to_route('users.index');
    }
}
