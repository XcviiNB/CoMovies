<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create() {
        return inertia('User/Create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'      => 'required',
            'email'      => 'required|unique:users',
            'password'      => 'required'
        ]);

        User::create([
            'name'      => $request->name,
            'email'      => $request->email,
            'password'      => bcrypt($request->password),

        ]);

        return redirect('/login')->with('Info', 'Registered succesfully');
    }
}
