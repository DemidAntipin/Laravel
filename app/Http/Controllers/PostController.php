<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

use App\Events\PostCreated;	

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::with(['comments' => function ($query) {
            $query->where('status', Comment::STATUS_PUBLISHED);}])
            ->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function index()
    {
        $posts = Post::where('status', Post::STATUS_PUBLISHED)->orderBy('published_at', 'desc'	)->get();
	foreach ($posts as $post) {
    	    if ($post->published_at) {
        	$post->published_at = Carbon::parse($post->published_at)->setTimezone('Asia/Irkutsk');
    	    }
	}
        return view('posts.index', compact('posts'));
    }

    public function moderating()
    {
        $posts = Post::where('status', Post::STATUS_SUSPICIOUS)->get();
        return view('posts.moderating', compact('posts'));
    }

    public function publish_available()
    {
        $posts = Post::where('status', Post::STATUS_PUBLISHING_AWAITING)->orderBy('published_at', 'desc'  )->get();
        foreach ($posts as $post) {
            if ($post->published_at) {
                $post->published_at = Carbon::parse($post->published_at)->setTimezone('Asia/Irkutsk');
            }
        }
        return view('posts.queue', compact('posts'));
    }

    public function declined()
    {
        $posts = Post::where('status', Post::STATUS_HIDDEN)->get();
        return view('posts.declined', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

	$publishedAt = $data['published_at'] ? Carbon::createFromFormat('Y-m-d\TH:i', $data['published_at'], 'Asia/Irkutsk')->setTimezone('UTC') : null;

	$post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => Post::STATUS_NEW,
            'published_at' => $publishedAt,
        ]);

	event(new PostCreated($post));

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function edit($id)
    {
	$post = Post::findOrFail($id);
	return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
	$post = Post::findOrFail($id);

	$request->validate([
    	    'title' => 'required|string|max:255',
    	    'content' => 'required|string',
	]);

	$publishedAt = $request->input('published_at') ? Carbon::createFromFormat('Y-m-d\TH:i', $request->input('published_at'), 'Asia/Irkutsk')->setTimezone('UTC') : $post->published_at;

        $post->update([
    	    'title' => $request->input('title'),
    	    'content' => $request->input('content'),
    	    'published_at' => $publishedAt,
	]);

	event(new PostCreated($post));

	return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function check($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status' => Post::STATUS_PUBLISHING_AWAITING]);
        return redirect()->route('posts.moderating')->with('success', 'Post has been checked');
    }

    public function destroy($id)
    {
	$post = Post::findOrFail($id);
	$post->delete();

	return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

    public function publish($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status' => Post::STATUS_PUBLISHED, 'published_at' => now()]);

        return redirect()->route('posts.index')->with('success', 'Post published successfully');
    }

    public function unpublish($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status' => Post::STATUS_HIDDEN, 'published_at' => null]);

        return redirect()->route('posts.index')->with('success', 'Post has been hidden');
    }

}
