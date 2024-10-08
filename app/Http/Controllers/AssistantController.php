<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        return view ('assistant.dashboard');
    }

}
