<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkAdmin');
    }

    public function index()
    {
        return view ('admin.dashboard');
    }

    public function dentist()
    {
        return view ('admin.dentist');
    }

    public function schedule()
    {
        return view ('admin.schedule');
    }

    public function appointment()
    {
        return view ('admin.appointment');
    }

    public function patient()
    {
        return view ('admin.patient');
    }
}
