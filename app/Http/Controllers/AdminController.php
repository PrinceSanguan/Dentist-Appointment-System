<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        $patients = User::where('userRole', 'patient')->get();
        $totalPatients = $patients->count();
        $currentDate = date('F j, Y');

        $pendingAccount = User::where('status', 'inactive')->count();

        return view('admin.dashboard', compact('totalPatients', 'currentDate', 'pendingAccount'));
    }

    public function dentist()
    {
        $dentists = User::where('userRole', 'dentist')->get();
        
        $currentDate = date('F j, Y');

        return view ('admin.dentist', compact('currentDate', 'dentists'));
    }

    public function schedule()
    {
        $currentDate = date('F j, Y');

        return view ('admin.schedule', compact('currentDate'));
    }

    public function appointment()
    {
        $currentDate = date('F j, Y');
        $events = Event::all(['title', 'date']); // Adjust fields based on your event model
    
        return view('admin.appointment', compact('currentDate', 'events'));
    }

    public function patient()
    {
        // get the patient information in the user table
        $patients = User::where('userRole', 'patient')->get();

        $currentDate = date('F j, Y');

        // Pass to the view
        return view ('admin.patient', compact('patients', 'currentDate'));
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

    public function patientDeleteAccount($id)
    {
        // Find the patient by ID
        $patient = User::find($id);

        // Delete the patient
        $patient->delete();

        // Redirect back with success message (optional)
        return redirect()->back()->with('success', 'Account deleted successfully');
    }

    public function addDentistAccount(Request $request)
    {
        // Validate the request data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'number' => 'required',
            'address' => 'required|string|max:255',
            'dob' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Create a new user (dentist)
        $dentist = User::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),
            'userRole' => 'dentist',
            'password' => bcrypt($request->input('password')),
            'status' => 'active',
        ]);

        // Return success response for AJAX
        if ($dentist) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    public function dentistDeleteAccount($id)
    {
        // Find the delete by ID
        $delete = User::find($id);

        // Delete the delete
        $delete->delete();

        // Redirect back with success message (optional)
        return redirect()->back()->with('success', 'Account deleted successfully');
    }
}
