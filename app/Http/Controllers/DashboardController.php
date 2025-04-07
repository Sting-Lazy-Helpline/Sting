<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        
        if(Auth::user()->user_type == 'agent' )
            return redirect()->route('survey.create');
        else
            return view('dashboard');

    }
    public function liveAgentReport() {
        return view('live_agent_report');
    }
}
