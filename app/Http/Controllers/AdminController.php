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

        return view('admin.dashboard', compact('totalPatients', 'currentDate'));
    }

    public function dentist()
    {

        $currentDate = date('F j, Y');

        return view ('admin.dentist', compact('currentDate'));
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
}
