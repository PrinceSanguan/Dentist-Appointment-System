<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class IndexController extends Controller
{
    public function index()
    {
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
    
        $currentMonth = now()->format('F Y'); 

        return view('welcome', compact('events', 'currentMonth', 'formattedEvents'));
    }

    public function signin()
    {
        return view ('signin');
    }
    
}
