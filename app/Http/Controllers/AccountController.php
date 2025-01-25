<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
        return view('auth.login');
    }

    public function home(){
        return view('Movie.home');
    }

    public function register(Request $request){
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
            'role' => 'user',
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
            if ($user && $user->isUser()) {
                return redirect()->route('home_movie');
            }
            elseif($user && $user->isAdmin()){
                return redirect()->route('admin_dashboard');
            }
            
        }

        return redirect()->back()->withErrors(['username'=>'Invalid username or password.']);
    }
}
