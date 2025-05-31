<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|string|max:255',
            'user_id' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'year' => $request->year,
            'user_id' => $request->user_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'تم التسجيل بنجاح!');
    }

    public function showSignin()
    {
        return view('signin');
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('signin'); // Make sure your sign in route is named 'signin'
        }
    }
}
