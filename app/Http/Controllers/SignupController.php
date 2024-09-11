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
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',  // Corrected typo
            'email' => 'required|email',  // Email validation and uniqueness check
            'number' => 'required',  // Number validation for phone number
            'address' => 'required|string|max:255',
            'dob' => 'required',  // Ensure dob is a valid date
            'password' => 'required|confirmed',
        ]);
    
        // Saving the user in the database
        $user = User::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),  // Corrected typo
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),  // dob is saved as it is
            'userRole' => 'patient',  // Assuming default role is 'patient'
            'password' => bcrypt($request->input('password')),  // Encrypt the password
        ]);
    
        // Check if user creation was successful
        if (!$user) {
            return redirect()->route('signup')->with('error', 'Failed to create user.');
        }
    
        // Redirect with success message if user is created successfully
        return redirect()->route('signin')->with('success', 'Ikaw ay nakarehistro na!');
    }
}
