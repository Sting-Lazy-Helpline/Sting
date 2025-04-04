<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route('survey.create');
        // return view('dashboard');
        // if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')
            // return redirect()->route('propect.index');
        // else
            // return redirect()->route('my-application');

    }
    public function liveAgentReport() {
        return view('live_agent_report');
    }
}
