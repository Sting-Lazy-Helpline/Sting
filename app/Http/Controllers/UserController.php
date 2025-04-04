<?php

namespace App\Http\Controllers;

use App\Interface\ApiResponseInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File as FileObj;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $apiResponse;

    public function __construct(ApiResponseInterface $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::whereIn('user_type',['admin','staff'])->get();
        return view('user/user_index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user/user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'avatar' => 'required',
            'email' => 'required', // Ensures it's an array with exactly 2 elements
            'password' =>  'required',
            'user_role' =>  'required',
        ]);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_type' => $request->user_role,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('avatar')) {
        
            $path = "uploads/profile/" . Auth::user()->id;
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $user->profile_picture = $path. "/" . $filename;

        }
        $user->addRole($request->user_role);
        $user->save();

        return  $this->apiResponse->success('User successfully created');

    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user/user_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'max:255', 'string', 'unique:users,email,'. $user->id],
            // 'password' =>  'required',
            // 'user_role' =>  'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->user_type = $request->user_role;

        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('avatar')) {
        
            $path = "uploads/profile/" . Auth::user()->id;
            $file = $request->file('avatar');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path($path), $filename);
            $user->profile_picture = $path. "/" . $filename;

        }

        // $user->addRole($request->user_role);
        $user->save();

        return  $this->apiResponse->success('User Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->profile_picture != 'uploads/profile/blank.png') {
            FileObj::delete($user->profile_picture);
        }
        $user->removeRole($user->user_type);
        $user->delete();
        return true;
    }
}
