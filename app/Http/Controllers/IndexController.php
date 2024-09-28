<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class IndexController extends Controller
{
    public function index()
    {
        return view ('welcome');
    }

    public function signin()
    {
        return view ('signin');
    }

    // Function to return events as JSON
    public function calendar() {
        $events = Event::all();
        return response()->json($events);
    }
}
