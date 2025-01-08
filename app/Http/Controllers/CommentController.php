<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\CommentCreated;

class CommentController extends Controller
{
    public function store(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    $post = Post::findOrFail($id);

    $comment = Comment::create([
        'content' => $request->content,
        'post_id' => $post->id,
        'status' => Comment::STATUS_NEW,
    ]);

    event(new CommentCreated($comment));

    return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully!');
}
}

