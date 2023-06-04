<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RequestController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $requestmovies = ModelsRequest::all();

        return Inertia::render('RequestMovie/Index', [
            'requestmovies' => $requestmovies,
            'user'  => $user
        ]);
    }

    public function create()
    {
        return Inertia::render('RequestMovie/Create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'user') {
            $request->validate([
                'title' => 'required',
                'director' => 'required',
            ]);

            ModelsRequest::create([
                'title' => $request->input('title'),
                'director' => $request->input('director'),
            ]);

            return redirect('/requests');
        }


    }
}
