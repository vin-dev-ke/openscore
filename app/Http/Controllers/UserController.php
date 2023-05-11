<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //All users
    public function index ()
    {
        $role = Auth::user()->roles[0]->first();

        try {
            // Check if the current user is an admin
            if (!$role === 'admin') {
                throw new \Exception('Access denied.');
            }
    
            // If the user is an admin, show the users page
            $users = User::withTrashed()->paginate(2);
            return Inertia::render('Users', [
                'users' => $users
            ]);
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
