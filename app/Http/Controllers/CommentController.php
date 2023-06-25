<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Scam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{  
    public function show (int $id)
    {
        $post = Scam::with('comments.user')->findOrFail($id);
        $comments = $post->comments;

        return Inertia::render('UserDash', [
            'comments' => $comments,
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

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete(); 
        
        return redirect()->back();
    }
}
