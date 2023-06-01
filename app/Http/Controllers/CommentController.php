<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Scam;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommentController extends Controller
{  
    public function index (Scam $id)
    {
        $post = Scam::find($id)->first();
        $comments = $post->comments;
        
        return Inertia::render('UserDash', [
            'comments' => $comments,
        ]);
    }

    public function store (Request $request, Scam $id)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $scam = Scam::find($id)->first();
        
        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->scam_id = $scam->id;
        $comment->save();

        return redirect()->back();
    }
}
