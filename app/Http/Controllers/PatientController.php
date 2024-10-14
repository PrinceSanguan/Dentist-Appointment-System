<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\ConcernBox;


class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkPatient');
    }

    public function index()
    {
        $currentDate = date('F j, Y');
        $patientName = auth()->user()->full_name; 
    
        return view('patient.dashboard', compact('currentDate', 'patientName'));
    }

    public function logout(Request $request)
    {
        // Get the current user
        $user = Auth::user();

        // Check if user is authenticated
        if ($user) {
            // Update the latest audit log for this user
            $auditLog = Audit::where('user_id', $user->id)->latest()->first();
            
            if ($auditLog) {
                $auditLog->updated_at = now(); // Set the updated_at to the current time
                $auditLog->save(); // Save the changes
            }

            // Logout the user
            Auth::logout();

            // Redirect to the desired route after logout
            return redirect()->route('signin')->with('success', 'Successfully logged out.');
        }

        // If user is not logged in, redirect with an error message
        return redirect()->route('signin')->with('error', 'You are not logged in.');
    }

    public function appointment()
    {
        $currentDate = date('F j, Y');

        return view ('patient.appointment', compact('currentDate'));
    }
    
    public function dentist()
    {
        $dentists = User::where('userRole', 'dentist')->get();
        $currentDate = date('F j, Y');

        return view ('patient.dentist', compact('currentDate', 'dentists'));
    }

    public function settings()
    {
        $currentDate = date('F j, Y');
        $user = auth()->user(); // Get the currently authenticated user
    
        return view('patient.settings', compact('currentDate', 'user'));
    }

    public function editUserProfile(Request $request)
    {
        
        // Check the parameters
       $request->validate([
        'full_name' => 'required',
        'email' => 'required',
        'number' => 'required',
        'address' => 'required',
        'dob' => 'required',
        ]);

        // Find the category by ID
        $user = User::find($request->input('id'));

        //update in the database based on id
        $user->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'dob' => $request->dob,
        ]);

        // return to the frontent
        return redirect()->back()->with('success', 'Successfully Updated');

    }

    public function userChangePassword(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'current_password' => 'required',
            'new_password' => [
                'required',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d).{6,}$/',
            ],
            'confirm_password' => 'required|same:new_password',
        ]);
    
        $user = auth()->user();
    
        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'errors' => ['current_password' => ['Incorrect current password']]
            ], 422);
        }
    
        // Update the user's password
        $user->update(['password' => Hash::make($request->new_password)]);
    
        // Return a success response
        return response()->json(['message' => 'Password changed successfully!']);
    }

    public function userDelete()
    {
        $user = auth()->user();
        $user->delete(); // Delete the user

        return response()->json(['message' => 'Your account has been deleted successfully.']);
    }

    public function concern()
    {
        $currentDate = date('F j, Y');
    
        // Use `where` instead of `Where` and `Auth::id()` for authenticated user ID
        $concerns = ConcernBox::where('user_id', Auth::id())->get();
    
        // Pass the variables to the view using compact
        return view('patient.concern', compact('currentDate', 'concerns'));
    }

    public function userConcernInput(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // Saving in the database
        $concern = ConcernBox::create([
            'user_id' => $user->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => 'open',
        ]);

        if (!$concern) {
            return redirect()->route('patient.concern')->with('error', 'Failed to create concern.');
        }
    
        // Redirect with success message
        return redirect()->back()->with('success', 'Your concern has been sent.');
    }
}
