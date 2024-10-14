<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use Illuminate\Support\Facades\Hash;

class AssistantController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkAssistant');
    }

    public function index()
    {
        $currentDate = date('F j, Y');
        $pendingAccount = User::where('status', 'inactive')->count();

        return view ('assistant.dashboard', compact('currentDate', 'pendingAccount'));
    }

    public function appointmentRequest()
    {
        return view ('assistant.appointment-request');
    }

    public function pendingAccount()
    {
        // get the patient information in the user table
        $patients = User::where('userRole', 'patient')->get();
        $currentDate = date('F j, Y');

        return view ('assistant.pending-account', compact('patients', 'currentDate'));
    }

    public function updatePatientStatus(Request $request, $id)
    {

        // Find the patient by ID
        $patient = User::findOrFail($id);
    
        // update the status from inactive to active
        $patient->status = $patient->status == 'active' ? 'inactive' : 'active';

        $patient->save();
        
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Patient status updated successfully');
    }

    public function settings()
    {
        $currentDate = date('F j, Y');
        $user = auth()->user();
        return view ('assistant.settings', compact('currentDate', 'user'));
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

    public function assistantChangePassword(Request $request)
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

    public function editAssistantProfile(Request $request)
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

    public function userDelete()
    {
        $user = auth()->user();
        $user->delete(); // Delete the Dentist

        return response()->json(['message' => 'Your account has been deleted successfully.']);
    }

}
