<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'Login Aplikasi']);
    }

    public function register()
    {
        return view('register');
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }
        return back()->with('loginError', ' anda tidak bisa masuk');
    }

    public function store(Request $request)
    {
        // dd($request);
        $vaslidatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'photo' => 'required|max:255',
            'role' => 'required|max:10'
        ]);

        // $vaslidatedData['password'] = bcrypt($vaslidatedData['password']);
        $vaslidatedData['password'] = Hash::make($vaslidatedData['password']);
        User::create($vaslidatedData);
        // $request->session()->flash('success', 'Registration successfull!! please login');
        return redirect('/')->with('success', 'Registration successfull!! please login');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'anda berhasil logout');
    }
}
