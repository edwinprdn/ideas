<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validation = request()->validate(
            [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3|max:40'
            ]
        );

        $user = User::create(
            [
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password'])
            ]
        );

        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('dashboard')->with('success', 'Your account has been created.');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        // dd(request()->all());
        $validation = request()->validate(
            [
            'email' => 'required|email',
            'password' => 'required'
            ]
        );

        if (auth()->attempt($validation)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', 'Logged in successfully.');
        }

        return redirect()->route('login')->withErrors(
            [
            'email' => 'No matching user found with the provided email and password'
            ]
        );
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', 'Logged out successfully.');
    }
}
