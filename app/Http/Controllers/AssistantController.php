<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

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
        $pendingAppointment = Member::where('status', 'pending')->count();

        return view ('assistant.dashboard', compact('currentDate', 'pendingAccount', 'pendingAppointment'));
    }

    public function appointmentRequest()
    {
        $currentDate = date('F j, Y');
    
        // Fetch all appointments with related user and appointment session data
        $appointments = Member::with(['user', 'appointmentSession.user'])
            ->get();
    
        return view('assistant.appointment-request', compact('appointments', 'currentDate'));
    }
    
    public function approveAppointment($id)
    {
        $appointment = Member::find($id);
        
        if ($appointment) {
            $appointment->update(['status' => 'approved']);
            return redirect()->back()->with('success', 'Appointment approved successfully.');
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }

    public function disapproveAppointment($id)
    {
        $appointment = Member::find($id);
        
        if ($appointment) {
            $appointment->update(['status' => 'disapproved']);
            return redirect()->back()->with('success', 'Appointment disapproved successfully.');
        }

        return redirect()->back()->with('error', 'Appointment not found.');
    }

    // Fetch patient details for 'view'
    public function viewAppointmentDetails($id)
    {
        $appointment = Member::with(['user', 'appointmentSession.user'])->find($id);
        
        if ($appointment) {
            return response()->json($appointment);
        }

        return response()->json(['error' => 'Appointment not found'], 404);
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

    public function patient()
    {
        $currentDate = date('F j, Y');
        $patients = User::where('userRole', 'patient')->get();

        return view ('assistant.patient', compact('currentDate', 'patients'));
    }

    public function viewPatient($id)
    {
        // Fetch patient details
        $patient = User::findOrFail($id);
    
        // Fetch all approved appointments for the patient
        $approvedAppointments = Member::where('user_id', $id)
                                    ->where('status', 'approved')
                                    ->with('appointmentSession')  // Load related appointment sessions
                                    ->orderBy('created_at', 'desc')
                                    ->get();
    
        if ($approvedAppointments->isNotEmpty()) {
            // Initialize HTML structure
            $html = '
                <div style="text-align: center;">
                    <h2>Monash Dental</h2>
                    <h4>Appointment Completion Report</h4>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <p><strong>Patient Number:</strong> ' . $patient->id . '</p>
                    <p><strong>Patient Name:</strong> ' . $patient->full_name . '</p>
                </div>
            ';
    
            // Start the table structure
            $html .= '
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Appointment Session Title</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
    
            $totalPrice = 0;
    
            // Loop through each appointment session and display details
            foreach ($approvedAppointments as $appointment) {
                $appointmentSession = $appointment->appointmentSession;
    
                $html .= '
                    <tr>
                        <td>' . $appointmentSession->session_title . '</td>
                        <td>₱' . number_format($appointmentSession->price, 2) . '</td>
                    </tr>
                ';
    
                // Calculate total price
                $totalPrice += $appointmentSession->price;
            }
    
            // Close the table and add the total price at the bottom
            $html .= '
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>₱' . number_format($totalPrice, 2) . '</strong></td>
                        </tr>
                    </tfoot>
                </table>
            ';
    
        } else {
            // If no approved appointments found
            $html = '<p>No approved appointments found for this patient.</p>';
        }
    
        return response()->json(['html' => $html]);
    }

}
