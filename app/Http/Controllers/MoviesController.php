<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function admin_page(){
        return view('Movie.admin');
    }
    public function index()
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:genres',
        ]);

        $genre = Genre::create(['name' => $request->name]);
        return response()->json(['success' => true, 'genre' => $genre]);
    }

    public function destroy($id)
    {
        $genre = Genre::find($id);
        if ($genre) {
            $genre->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Genre not found']);
    }

    public function movieStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:movies',
            'release_date' => 'required|date',
            'ratings' => 'required|integer|min:1|max:5',
            'duration' => 'required|string',
            'cast' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Movies::create([
            'title' => $request->title,
            'release_date' => $request->release_date,
            'ratings' => $request->ratings,
            'duration' => $request->duration,
            'cast' => $request->cast,
            'description' => $request->description,
            'image' => $imagePath,
            'genre_id' => $request->genre_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Movie added successfully']);
    }
    public function getMovies()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('home_movie')->with('error', 'Access denied. Admins only.');
        }

        $movies = Movies::with('genre')->get();
        return view('Movie.admin', compact('movies'));
    }

    public function editMovie(Request $request, $id){
        $movie = Movies::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->genre_id = $request->input('genre_id');
        $movie->release_date = $request->input('release_date');
        $movie->ratings = $request->input('ratings');
        $movie->duration = $request->input('duration');
        $movie->cast = $request->input('cast');
        $movie->description = $request->input('description');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $movie->image = basename($path);
        }

        $movie->save();

        return response()->json(['success' => true]);
    }
    
}
