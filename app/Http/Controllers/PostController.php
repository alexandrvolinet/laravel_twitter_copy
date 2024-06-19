<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function userPosts()
    {
        $userId = Auth::id();
        $posts = Post::with('user')->where('user_id', $userId)->latest()->get();
        $users = User::where('id', '!=', $userId)->get();
        return view('dashboard', compact('posts', 'users'));
    }

    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        $userId = Auth::id();
        $users = User::where('id', '!=', $userId)->get();
        return view('welcome', compact('posts', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $request->file('image') ? $request->file('image')->store('posts', 's3') : null;

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'image_path' => $path,
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        if ($post->image_path) {
            Storage::disk('s3')->delete($post->image_path);
        }

        $post->delete();

        return redirect()->route('posts.index');
    }
}