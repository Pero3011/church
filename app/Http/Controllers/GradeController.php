<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        // If admin is logged in via session
        if (session('admin_name')) {
            $users = \App\Models\User::all();
            return view('grade', compact('users'));
        }

        // If a normal user is logged in
        if (Auth::check()) {
            $user = Auth::user();
            return view('grade', ['user' => $user]);
        }

        // If neither, redirect to login
        return redirect('/signin')->withErrors(['يجب تسجيل الدخول أولاً']);
    }
}
