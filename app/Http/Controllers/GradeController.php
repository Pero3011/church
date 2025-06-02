<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class GradeController extends Controller
{
    public function index()
    {
        // If an admin is logged in (via session), show all users' info
        if (session('admin_name')) {
            $users = User::all();
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
