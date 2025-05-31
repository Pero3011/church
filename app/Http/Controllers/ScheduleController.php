<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::orderBy('date')->get();
        return view('schedule', compact('schedules'));
    }
}
