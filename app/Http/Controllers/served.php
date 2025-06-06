<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class served extends Controller
{
    public function showUsers()
    {
        $users = User::all(); // or your query
        return view('served', compact('users'));
    }

    public function destroy(User $user)
    {
        // Delete the user record
        $user->delete();

        return redirect()->route('served')->with('success', 'تم حذف المستخدم بنجاح!');
    }
}

