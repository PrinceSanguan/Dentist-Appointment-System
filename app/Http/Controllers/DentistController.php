<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AppointmentSession;
use App\Models\Event;
use App\Models\Member;

class DentistController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkDentist');
    }

    public function index()
    {
        $totalPatients = User::where('userRole', 'patient')->count();
        $totalDentists = User::where('userRole', 'dentist')->count();
        $currentDate = date('F j, Y');
        $dentistName = auth()->user()->full_name;

        return view ('dentist.dashboard', compact('currentDate', 'dentistName', 'totalPatients', 'totalDentists'));
    }

    public function settings() 
    {
        $currentDate = date('F j, Y');
        $user = auth()->user();

        return view ('dentist.settings', compact('currentDate', 'user'));
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

    public function dentistChangePassword(Request $request)
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

    public function editDentistProfile(Request $request)
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

    public function session()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Get the current date in 'F j, Y' format
        $currentDate = date('F j, Y');
        
        // Fetch the appointment sessions where the user_id matches the authenticated user,
        
        // including the members and their related user data
        $sessions = AppointmentSession::with('members.user')
            ->where('user_id', $user->id) // Filter by authenticated user ID
            ->get();
        
        // Return the view with the necessary data
        return view('dentist.session', compact('currentDate', 'sessions'));
    }


    public function addSession(Request $request)
    {
        // Validate the request data with custom error messages
        $request->validate([
            'session_title' => 'required',  
            'schedule_date' => 'required',  
            'number_of_member' => 'required',
            'price' => 'required',
        ]);
    
        $dentist = auth()->user();
    
        // Create the AppointmentSession and store the result
        $appointmentSession = AppointmentSession::create([
            'user_id' => $dentist->id,  
            'session_title' => $request->input('session_title'),
            'schedule_date' => $request->input('schedule_date'),
            'number_of_member' => $request->input('number_of_member'),
            'price' => $request->input('price'),
        ]);
    
        // Check if appointment session creation was successful
        if (!$appointmentSession) {
            return redirect()->route('dentist.session')->with('error', 'Failed to create appointment session.');
        }
    
        // Create the associated Event
        Event::create([
            'user_id' => $dentist->id,
            'appointment_session_id' => $appointmentSession->id, // Use the ID of the newly created AppointmentSession
            'date' => $request->input('schedule_date'),
            'title' => $request->input('session_title'),
            'member' => $request->input('number_of_member'),
        ]);
    
        // Redirect with success message
        return redirect()->route('dentist.session')->with('success', 'Session Registered!');
    }

    public function cancelSession(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'session_id' => 'required|exists:appointment_sessions,id',
        ]);

        // Find the appointment session by its ID
        $session = AppointmentSession::findOrFail($request->session_id);

        // Delete all members associated with the session
        $session->members()->delete();

        // Find the event associated with this appointment session
        $event = Event::where('appointment_session_id', $session->id)->first();

        // If an event exists, delete it
        if ($event) {
            $event->delete();
        }

        // Delete the session itself
        $session->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Session and associated event canceled successfully.');
    }

    public function patient()
    {
        $currentDate = date('F j, Y');
    
        // Assuming the authenticated user is a doctor and has a relationship to appointments
        $doctorId = auth()->user()->id; // Get the authenticated doctor's ID
    
        // Fetch patients associated with the authenticated doctor's appointments
        $patients = Member::whereHas('appointmentSession', function($query) use ($doctorId) {
            $query->where('user_id', $doctorId); // Assuming there's a doctor_id field in the appointments table
        })->get();
    
        return view('dentist.patient', compact('currentDate', 'patients'));
    }
}
