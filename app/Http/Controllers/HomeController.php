<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()


    public function index()
{
    $posts = Post::with('user')->latest()->get();
    $userId = Auth::id();
    $users = User::where('id', '!=', $userId)->get();
    return view('welcome', compact('posts', 'users'));
}
}   