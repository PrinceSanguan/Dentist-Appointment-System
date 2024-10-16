<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class SignupController extends Controller
{
    public function index()
    {
        return view ('signup');
    }

    public function signup(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:255',  
            'email' => 'required|email|unique:users',  
            'number' => 'required',  
            'address' => 'required|string|max:255',
            'dob' => 'required|date',  
            'password' => 'required|confirmed',
        ]);

        // Create the user with status as 'inactive'
        $user = User::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),
            'userRole' => 'patient',
            'password' => Hash::make($request->input('password')),
            'status' => 'inactive',
        ]);

        // If the user was created, send the verification email
        if ($user) {
            // Dispatch the email verification event to trigger the email
            event(new Registered($user));

            return redirect()->route('signin')->with('success', 'You are registered! Please verify your email.');
        }

        // If user creation failed
        return redirect()->route('signup')->with('error', 'Failed to create user.');
    }

    
}
