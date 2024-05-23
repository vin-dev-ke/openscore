<?php

namespace App\Http\Controllers;

use App\Models\Scam;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class HomeController extends Controller
{
    public function index (Request $request)
    {
        $role = Auth::user()->getRoleNames()->first();
        $users_count = User::all()->count();
        $scams_count = Scam::all()->count();
        $scams = Scam::all();
        $comments = Comment::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                            ->groupBy('date')
                            ->orderBy('date')
                            ->get();

        if($role === 'admin') {
            return Inertia::render('AdminDash', [
                'users_count' => $users_count,
                'scams_count' => $scams_count,
                'scams' => $scams,
                'isAdmin' => true,
                'commentsData'=> $comments,
            ]);
        } else if ($role === 'moderator') {
            return Inertia::render('AdminDash', [
                'users_count' => $users_count,
                'scams_count' => $scams_count,
                'scams' => $scams,
                'isAdmin' => false,
                'commentsData'=> $comments,
            ]);
        } else {
            $user = Auth::user();
            $scams = Scam::when($request->search_term, function($query,$search_term){$query->where('contact', 'LIKE','%'.$search_term.'%');})
                    ->with('user')
                    ->whereNull('deleted_at')
                    ->orderBy('created_at', 'desc')
                    ->paginate(3);
            $myScams = $user->scams->count();
            return Inertia::render('UserDash', [
                'user' => $user,
                'scams' => $scams,
                'myScams' => $myScams
            ]);
        }

    }
}