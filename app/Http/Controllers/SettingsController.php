<?php

namespace App\Http\Controllers;

use App\Interface\ApiResponseInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseInterface $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('setting/user_setting', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $setting)
    {
        $request->validate([
            'name' => 'required',
            'address' => ['required'],
            'phone_number' =>  'required',
        ]);
       
     
        if ($request->hasFile('avatar')) {
            $previousPic = $setting->profile_picture;
            if ($previousPic != 'uploads/profile/blank.png') {
                File::delete($previousPic);
            }
            $path = "uploads/profile/" . $setting->id;
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $setting->profile_picture = $path. "/" . $filename;
        }
        
        $setting->name = $request->name;
        $setting->phone_number = $request->phone_number;
        $setting->address = $request->address;
        $setting->save();
      
        return  $this->apiResponse->success('Info successfully updated');
    }

    public function updateEmail(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'max:255', 'string', 'unique:users,email,'. $user->id],
            'confirmemailpassword' => ['required'],

        ]);

        if (Hash::check($request->confirmemailpassword, $user->password)) {
            $user->email = $request->email;
            $user->save();
            return  $this->apiResponse->success('Email successfully updated');


        } else {
            return  $this->apiResponse->error('Password does not match',200);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate($request, [
            'old_password' => 'required',
            'password' => 'confirmed|min:8|different:old_password',
        ]);
        if (Hash::check(Hash::make($request->old_password), $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password),
            ])->save();

            return  $this->apiResponse->success('Password changed successfully updated');

        } else {

            return  $this->apiResponse->error('Old password do not match',200);

        }
    }

   
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
   
}
