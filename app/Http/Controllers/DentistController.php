<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DentistController extends Controller
{
    public function index()
    {
        return view ('dentist.dashboard');
    }
}
