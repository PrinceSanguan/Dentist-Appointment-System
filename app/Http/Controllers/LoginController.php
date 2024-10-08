<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;

class LoginController extends Controller
{
    public function loginForm(Request $request)
    {
        // Validate the input data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication passed, now check the user's role
            $user = Auth::user();
    
            // Check if user's status is active
            if ($user->status === 'active') {
                // Create an audit log entry
                Audit::create([
                    'user_id' => $user->id,     // Add the user ID of the logged-in user
                    'updated_at' => null        // Explicitly set updated_at to null
                ]);
    
                // Role-based redirection
                switch ($user->userRole) {
                    case 'admin':
                        // Redirect to the admin dashboard
                        return redirect()->route('admin.dashboard');
    
                    case 'assistant':
                        // Redirect to the assistant dashboard
                        return redirect()->route('assistant.dashboard');
    
                    case 'dentist':
                        // Redirect to the dentist dashboard
                        return redirect()->route('dentist.dashboard');
    
                    case 'patient':
                        // Check if the patient's status is active
                        if ($user->status === 'active') {
                            // Redirect to the patient dashboard
                            return redirect()->route('patient.dashboard');
                        } else {
                            // Redirect back with an error message
                            return redirect()->route('signin')->with('error', 'Please wait for your account approval.');
                        }
    
                    default:
                        // Default redirect if role doesn't match
                        return redirect()->route('signin')->with('error', 'Unauthorized access.');
                }
            } else {
                // If user's status is not active, redirect with an error message
                return redirect()->route('signin')->with('error', 'Your account is not active.');
            }
        } else {
            // Authentication failed, redirect back with error message
            return redirect()->route('signin')->with('error', 'Invalid email or password.');
        }
    }
}
