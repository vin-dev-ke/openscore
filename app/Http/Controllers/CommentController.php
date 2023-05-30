<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Scam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{  
    public function index (Scam $postId)
    {
        $comments = $postId->comments;
        // dd($comments);
        return Inertia::render('UserDash', [
            'comments' => $comments,
        ]);
    }

    public function store (Request $request, int $postId)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $scam = Scam::findOrFail($postId);
        
        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->scam_id = $scam->id;
        $comment->save();

        return redirect()->back();
    }
}
