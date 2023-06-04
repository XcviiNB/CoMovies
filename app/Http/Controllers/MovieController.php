<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MovieController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $movies = Movie::all();

        return Inertia::render('Movies/Index', [
            'movies' => $movies,
            'user'  => $user
        ]);
    }

    public function create()
    {
        return Inertia::render('Movies/Create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            $request->validate([
                'title' => 'required',
                'release_date' => 'required|date',
                'director' => 'required',
                'genre' => 'required',
                'image' => 'required|image', // Optional: Validating image file with a maximum size of 2MB
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('movies', 'public');
            }

            Movie::create([
                'title' => $request->input('title'),
                'release_date' => $request->input('release_date'),
                'director' => $request->input('director'),
                'genre' => $request->input('genre'),
                'image' => $imagePath,
            ]);

            return redirect()->route('movies.index');
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


    }

    public function edit(Movie $movie)
    {
        if (Auth::user()->role === 'admin') {
            return inertia('Movies/Edit', [
                'movie' => $movie,
            ]);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function update(Request $request, Movie $movie)
    {
        if (Auth::user()->role === 'admin') {
            $request->validate([
                'title' => 'required',
                'release_date' => 'required|date',
                'director' => 'required',
                'genre' => 'required',
                'image' => 'nullable|image', // Optional: Validating image file with a maximum size of 2MB
            ]);

            $imagePath = $movie->image;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('movies', 'public');

                if ($movie->image) {
                    Storage::disk('public')->delete($movie->image);
                }
            }

            $movie->update([
                'title' => $request->input('title'),
                'release_date' => $request->input('release_date'),
                'director' => $request->input('director'),
                'genre' => $request->input('genre'),
                'image' => $imagePath,
            ]);

            return redirect('/movies')->with('success', 'Movie updated successfully!');
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }

    public function destroy(Movie $movie)
    {
        if (Auth::user()->role === 'admin') {
            if ($movie->image) {
                Storage::disk('public')->delete($movie->image);
            }

            $movie->delete();

            return redirect('/movies');
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
