<?php


namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    // public function show(User $user)
    // {
    //     $posts = $user->posts()->with('user')->latest()->get();
    //     $users = User::all();
    //     return view('users.show', compact('user', 'posts', 'users'));
    // }
    public function show(User $user)
{
    $posts = $user->posts()->with('user')->latest()->get();
    $currentUserId = Auth::id();
    $users = User::where('id', '!=', $currentUserId)->get();
    return view('users.show', compact('user', 'posts', 'users'));
}
    public function getUsers()
    {
        return User::all();
    }
}