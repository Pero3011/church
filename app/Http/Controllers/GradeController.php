<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        // If a user is logged in and is "خادم", show all users
        if (Auth::check() && Auth::user()->year == "خادم") {
            $users = \App\Models\User::all();
            return view('grade', compact('users'));
        }

        // If a normal user is logged in, show only their info
        if (Auth::check()) {
            $user = Auth::user();
            return view('grade', ['user' => $user]);
        }

        // If neither, redirect to login
        return redirect('/signin')->withErrors(['يجب تسجيل الدخول أولاً']);
    }
}
