<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Scam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{  
    public function index()
    {
        $comments = Comment::all();
        return response()->json(['comments' => $comments]);
    }

    public function show (int $id)
    {
        $user = Auth::user();
        $comments = Comment::with('scam','user')
            ->where('scam_id', $id)
            ->get();
        $search_term = "";
        $scams = Scam::when("", function($query,$search_term){$query->where('contact', 'LIKE','%'.$search_term.'%');})
            ->with('user')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(3);
        $myScams = $user->scams->count();

        return Inertia::render('UserDash', [
            'comments' => $comments,
            'user' => $user,
            'scams' => $scams,
            'myScams' => $myScams,
        ]);
    }

    public function store (Request $request, int $id)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $scam = Scam::findOrFail($id);

        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->scam_id = $scam->id;
        $comment->user_id = Auth::id();
        $comment->save();


        // Associate the comment with the scam relationship
        $scam->comments()->save($comment);

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('message', 'Comment deleted successfully');
    }
}
