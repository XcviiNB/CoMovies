<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        return inertia('Landing');
    }

    public function loginForm() {
        return inertia('Login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string'
        ]);

        $login = auth()->attempt($request->all());

        if($login)
            return redirect('/movies');
        else
            return back()->withErrors(['authentication'=>'Invalid email and/or password.']);
    }

    public function logout() {
        auth()->logout();
        return redirect('/login');
    }
}
