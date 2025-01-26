<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Movies;
use App\Models\Genre;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function registerForm(){
        return view('auth.register');
    }

    public function loginForm(){
        if (Auth::check()) {
            return redirect()->route('adminpage');
        }

        return view('auth.login');
    }

    public function home(Request $request){
        $topRatedMovies = Movies::orderBy('ratings', 'desc')
        ->orderBy('release_date', 'desc') 
        ->limit(5)
        ->get();

        $genres = Genre::all();

        // Filter movies by genre if a genre is selected
        $query = Movies::query();
        if ($request->has('genre') && $request->genre) {
            $query->where('genre_id', $request->genre);
        }

        // Get the filtered or all movies
        $allMovies = $query->orderBy('updated_at', 'desc')->get();

        return view('Movie.home', compact('topRatedMovies', 'allMovies', 'genres'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $movies = Movies::where('title', 'like', "%{$query}%")->get(['id', 'title']);
        return response()->json($movies);
    }

    public function register(Request $request){
        if (Account::where('role', 'admin')->exists()) {
            return redirect()->back()->withErrors(['error' => 'An admin account already exists. Registration is not allowed.']);
        }
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Account::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);

        return redirect('/login')->with('success','Registered Successfully');
        
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $account = Account::where('username', $request->username)->first();

        if($account && Hash::check($request->password,  $account->password)){
            Auth::login($account);

            Session::flash('success', 'Login Successfully');
            $user = Auth::user();
            if($user){
                return redirect()->route('adminpage');
            }
            
        }

        return redirect()->back()->withErrors(['username'=>'Invalid username or password.']);
    }

    public function logout()
    {
        Auth::logout(); 
        Session::flush();

        return redirect('/')->with('success', 'Logged out successfully.'); 
    }
}
