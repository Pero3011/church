<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
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
            'phone_number' => 'required|string|max:255|unique:users,phone_number|unique:admins,phone_number',
            'email' => 'required|email|unique:users,email|unique:admins,email',
            'password' => 'required|string|min:1|confirmed',
        ]);

        if ($request->year === 'خادم') 
        {
            // Store in admins table
            $admin = Admin::create([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            // Optionally log in as admin (custom session)
            session(['admin_name' => $admin->name, 'admin_id' => $admin->id]);
            return redirect('/')->with('success', 'تم التسجيل كخادم بنجاح!');
        } 

        else {
            // Store in users table
            $user = User::create([
                'name' => $request->name,
                'year' => $request->year,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);
            return redirect('/')->with('success', 'تم التسجيل بنجاح!');
        }
    }

    public function showSignin()
    {
        return view('signin');
    }

    public function signin(Request $request)
    {
        // Validate email and password fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Try to authenticate as admin first
        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Set admin session
            session(['admin_name' => $admin->name, 'admin_id' => $admin->id]);
            return redirect('/')->with('success', 'تم تسجيل الدخول كخادم بنجاح');
        }

        // Try to authenticate as user
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيح أو غير موجودة ارجو المحاوله مره اخرى او تسجيل حساب جديد']);
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
