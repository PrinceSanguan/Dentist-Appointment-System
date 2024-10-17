<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Audit;
use App\Models\ConcernBox;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $dentist = User::where('userRole', 'dentist')->count();
        $assistant = User::where('userRole', 'assistant')->count();
        $openConcern = ConcernBox::where('status', 'open')->count();

        return view('admin.dashboard', compact('totalPatients', 'currentDate', 'pendingAccount', 'dentist', 'assistant', 'openConcern'));
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

        // Fetch events with the related user (doctor)
        $events = Event::with('user')->get();

        // Format the events with doctor's name
        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => '"' . $event->title . '"' . '<br>Dr. ' . $event->user->full_name, // Title with a line break before the doctor's name
                'date' => $event->date,
                'doctor' => $event->user->full_name // Include doctor's name in the event
            ];
        });

        // Return the view with the correct compact syntax
        return view('admin.appointment', compact('currentDate', 'formattedEvents'));
    }

    public function patient()
    {
        // get the patient information in the user table
        $patients = User::where('userRole', 'patient')->get();

        $currentDate = date('F j, Y');

        // Pass to the view
        return view ('admin.patient', compact('patients', 'currentDate'));
    }

    public function viewPatient($id)
    {
        $patient = User::findOrFail($id); // Fetch patient details

        // Create an HTML snippet to return
        $html = '
            <div>
                <h4>Name: ' . $patient->full_name . '</h4>
                <p>Email: ' . $patient->email . '</p>
                <p>Phone: ' . $patient->number . '</p>
                <p>Address: ' . $patient->address . '</p>
                <!-- Add more patient details as needed -->
            </div>
        ';

        return response()->json(['html' => $html]);
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

    public function assistant()
    {
        $assistants = User::where('userRole', 'assistant')->get();

        $currentDate = date('F j, Y');

        return view ('admin.assistant', compact('currentDate', 'assistants'));
    }

    public function addAssistantAccount(Request $request)
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

        // Create a new user (assistant)
        $assistant = User::create([
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'number' => $request->input('number'),
            'address' => $request->input('address'),
            'dob' => $request->input('dob'),
            'userRole' => 'assistant',
            'password' => bcrypt($request->input('password')),
            'status' => 'active',
        ]);

        // Return success response for AJAX
        if ($assistant) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    public function assistantDeleteAccount($id)
    {
        // Find the delete by ID
        $delete = User::find($id);

        // Delete the delete
        $delete->delete();

        // Redirect back with success message (optional)
        return redirect()->back()->with('success', 'Account deleted successfully');
    }

    public function auditLogs()
    {
        $currentDate = date('F j, Y');
        $logs = Audit::with('user')->orderBy('created_at', 'asc')->get();

        return view ('admin.audit-logs', compact('currentDate', 'logs'));
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


    public function concern()
    {
        $currentDate = date('F j, Y');
        $concerns = ConcernBox::all();

        return view ('admin.concern', compact('currentDate', 'concerns'));
    }

    public function concernReply(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'concern_id' => 'required|exists:concern_boxes,id',  // Ensure the concern exists
            'reply' => 'required|string|max:255',                // Validate the reply
        ]);

        // Find the concern by ID
        $concern = ConcernBox::find($request->input('concern_id'));

        // Update the reply
        $concern->reply = $request->input('reply');
        $concern->status = 'close';
        $concern->save();  // Save the updated reply to the database

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Reply saved successfully.',
            'concern' => $concern,
        ]);
    }

    public function settings()
    {
        
        $currentDate = date('F j, Y');
        $user = auth()->user();

        return view ('admin.settings', compact('currentDate', 'user'));
    }

    public function editAdminProfile(Request $request)
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

    public function adminChangePassword(Request $request)
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
}

