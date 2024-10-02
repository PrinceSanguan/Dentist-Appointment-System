<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignupController extends Controller
{
    public function index()
    {
        return view ('signup');
    }

    public function signup(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'full_name' => 'required|string|max:255',  
            'email' => 'required|email|unique:users',  
            'number' => 'required',  
            'address' => 'required|string|max:255',
            'dob' => 'required',  
            'password' => 'required|confirmed',
        ]);
    
        // If email does not exist, proceed to create the user
        $user = User::create([
            'full_name' => $request->input('full_name'),  
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),  
            'userRole' => 'patient',  
            'password' => bcrypt($request->input('password')),
            'status' => 'inactive',  
        ]);
    
        // Check if user creation was successful
        if (!$user) {
            return redirect()->route('signup')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message if user is created successfully
        return redirect()->route('signin')->with('success', 'You are registered!');
    }
}
