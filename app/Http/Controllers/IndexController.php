<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class IndexController extends Controller
{
    public function index()
    {
        $events = Event::all(['title', 'date']);
    
        $currentMonth = now()->format('F Y'); 

        return view('welcome', compact('events', 'currentMonth'));
    }

    public function signin()
    {
        return view ('signin');
    }

}
