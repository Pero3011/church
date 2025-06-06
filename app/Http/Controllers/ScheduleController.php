<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin_name') && !Auth::check()) {
            return redirect('/signin')->withErrors(['يجب تسجيل الدخول أولاً']);
        }

        $schedules = Schedule::orderBy('date')->get();
        return view('schedule', compact('schedules'));
    }
}
