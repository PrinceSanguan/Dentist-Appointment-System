<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\ConcernBox;
use App\Models\AppointmentSession;
use App\Models\Member;


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
    
        // Fetch all dentists (users with role 'dentist')
        $dentists = User::where('userRole', 'dentist')->get();
    
        // Fetch the authenticated user's appointments only
        $userId = auth()->user()->id; // Get the currently authenticated user's ID
    
        // Fetch all existing appointment sessions (which include services) and related members (appointments)
        $appointments = Member::with('appointmentSession.user')  // Get appointment sessions with their dentists (users)
                              ->where('user_id', $userId) // Filter appointments for the authenticated user
                              ->get(['appointment_session_id', 'user_id', 'time', 'status', 'created_at']);  // We fetch session and time details
    
        return view('patient.appointment', compact('currentDate', 'dentists', 'appointments'));
    }

    public function getDentistServices($dentistId)
    {
        $services = AppointmentSession::where('user_id', $dentistId)->get(['id', 'session_title']);
        return response()->json($services);
    }

    public function bookAppointment(Request $request)
    {
        // Validate request
        $request->validate([
            'dentist' => 'required|exists:users,id',
            'appointment_session' => 'required|exists:appointment_sessions,id',
            'appointment_time' => 'required',
        ]);
    
        // Check if the selected time is already booked for the same session
        $timeAlreadyBooked = Member::where('appointment_session_id', $request->appointment_session)
                                   ->where('time', $request->appointment_time)
                                   ->exists();
    
        if ($timeAlreadyBooked) {
            return redirect()->back()->with('error', 'The time you selected has already been booked. Please choose another time.');
        }
    
        // Check if the user has already booked in the same session
        $userAlreadyBooked = Member::where('user_id', Auth::id())
                                   ->where('appointment_session_id', $request->appointment_session)
                                   ->exists();
    
        if ($userAlreadyBooked) {
            return redirect()->back()->with('error', 'You have already booked this session. You cannot book the same session twice.');
        }
    
        // If no conflicts, save the appointment
        $member = Member::create([
            'user_id' => Auth::id(),
            'appointment_session_id' => $request->appointment_session,
            'time' => $request->appointment_time,
            'status' => 'pending',
        ]);
    
        if ($member) {
            return redirect()->back()->with('success', 'Appointment booked successfully.');
        }
    
        return redirect()->back()->with('error', 'Failed to book the appointment.');
    }

    public function getAvailableTimes($dentistId, $serviceId)
    {
        $bookedTimes = Member::whereHas('appointmentSession', function ($query) use ($dentistId, $serviceId) {
            $query->where('user_id', $dentistId)
                  ->where('appointment_session_id', $serviceId);
        })->pluck('time')->toArray();  // Get booked times as an array
    
        $bookedTimesFormatted = array_map(function ($time) {
            return date('g:i A', strtotime($time));  // Ensure consistent format
        }, $bookedTimes);
    
        $allTimes = $this->generateTimeSlots();
        $availableTimes = array_diff($allTimes, $bookedTimesFormatted);
    
        return response()->json([
            'available_times' => array_values($availableTimes),
            'booked_times' => array_values($bookedTimesFormatted)  // Return booked times
        ]);
    }
    
    private function generateTimeSlots()
    {
        $timeSlots = [];
        $startTime = 7 * 60; // 7:00 AM in minutes
        $endTime = 16 * 60; // 4:00 PM in minutes
        $interval = 30; // 30 minutes
    
        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $hours = floor($time / 60);
            $minutes = $time % 60;
            $formattedTime = sprintf("%02d:%02d %s", ($hours % 12 == 0 ? 12 : $hours % 12), $minutes, $hours >= 12 ? 'PM' : 'AM');
            $timeSlots[] = $formattedTime;  // Add formatted time to the list
        }
    
        return $timeSlots;
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
