<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/aaaaaaaaaaaa', function () {
//     // Auth::login($user);
//     // $user->addRole(strtolower($request->method));
//     // $data=array();->middleware(['auth', 'verified'])
//     // $data['name']=$request->name;
//     // sendEmail($request->email,"Welcome email on Registration $request->name",'template/template_register',$data);
//     $data['name']='aaaaaaaaaaa';
//     $data['email']='aaaaaaaaaaa';
//     $data['password']='aaaaaaaaaaa';
//     return view('template/template_propect_accepted',compact('data'));
// })->name('aaaaaaaaaaaa');

Route::middleware('auth')->group(function () {
    Route::get('dashboard',  [DashboardController::class, 'index'])->name('dashboard');
    Route::get('live-agent-report',  [DashboardController::class, 'liveAgentReport'])->name('live-agent-report');

    Route::resource('user', UserController::class);

    Route::resource('survey', SurveyController::class);
    
    Route::resource('settings', SettingsController::class);
    Route::post('/settings/{id}/updateEmail', [SettingsController::class, 'updateEmail'])->name('updateEmail');
    Route::post('/settings/{id}/updatePassword', [SettingsController::class, 'updatePassword'])->name('updatePassword');
});

require __DIR__.'/auth.php';
