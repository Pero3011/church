<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class served extends Controller
{
    public function showUsers(Request $request)
    {
        $query = User::query();
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        $users = $query->get();
        return view('served', compact('users'));
    }

    public function destroy(User $user)
    {
        // Delete the user record
        $user->delete();

        return redirect()->route('served')->with('success', 'تم حذف المستخدم بنجاح!');
    }
}

