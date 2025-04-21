<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Event\Telemetry\Duration;

class DashboardController extends Controller
{
    public function index()
    {
        
        if(Auth::user()->user_type == 'agent' )
            return redirect()->route('survey.create');
        else
            return view('dashboard');

    }
    public function dashboardData(Request $request)
    {
        if ($request->ajax()) {
            $startDatea = date('Y-m-d'); // First day of current month
            $endDatea = date('Y-m-d');    // Last day of current month
            $query="AND DATE(calldate) BETWEEN '$startDatea' AND '$endDatea'";
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            if($startDate && $endDate)
            {
                $query="AND DATE(calldate) BETWEEN '$startDate' AND '$endDate'";
            }
            $answerAndNoAnswer = DB::connection('call')->select("SELECT DATE_FORMAT(calldate,'%Y-%m-%d') AS DATE, disposition AS CallStatus, COUNT(DISTINCT(src)) AS Counts FROM as_cdr 
                WHERE vpbx_id = '717' AND call_type = 'inbound' AND lastapp = 'Dial' $query GROUP BY disposition");

            $callDetails = DB::connection('call')->select("SELECT DATE_FORMAT(calldate,'%Y-%m-%d') AS DATE, COUNT(src) AS TodayCalls, COUNT(DISTINCT(src)) AS UniqueCallers, SUM(CEIL(billsec/60)) AS TalkTimeMinutes 
            FROM as_cdr WHERE vpbx_id = '717' AND call_type = 'inbound' $query");

            return ["answerAndNoAnswer"=>$answerAndNoAnswer,"callDetails"=>$callDetails];
        }

    }
    public function liveAgentReport() {
        return view('live_agent_report');
    }
}
