<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        User::where('role','staff')->get();
        return view('pages.addStaff');

    }

    public function create()
    {
        return view('pages.addStaff');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'], // Name cannot have numbers or special characters
            'email' => ['required', 'email'],
            'phoneNo' => ['required', 'regex:/^(01)[0-9]-*[0-9]{7,8}$/'], // Malaysian phone number format
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password'],
            'identityNo' => ['required','regex:/^\d{6}-\d{2}-\d{4}$/'], // Assuming identity number is numeric
            'address' => ['required', 'string'],
            'role' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phoneNo' => $request->phoneNo,
            'role' => $request->role,
            'gender' => $request->gender,
            'nationality' => "Malaysia",
            'identityNo' => $request->identityNo,
            'address' => $request->address
        ]);

        $staffID = IdGenerator::generate(['table'=> 'staff','field' => 'staffID','length' => 6, 'prefix' => 'S']);
        $currentDateTime = Carbon::now();

        Staff::create([
            'staffID' => $staffID,
            'lastSeen'=> $currentDateTime,
            'status' => "Just Created",
            'userID' => $user->userID
        ]);
        

        if($request->role == "admin"){
            $adminID = IdGenerator::generate(['table'=> 'admin','field' => 'adminID','length' => 6, 'prefix' => 'ADMIN']);

            Admin::create([
                'adminID' => $adminID,
                'staffID' => $staffID,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Staff account created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::where('staffID', $id)->first();
        $user = User::where('userID', $staff->userID)->first();

        if ($user->role === 'admin') {
            Admin::where('staffID', $id)->delete();
        } 
        // Delete the user, staff, and admin based on the user type
        User::where('userID', $staff->userID)->delete();
        Staff::where('staffID', $id)->delete();
    
        return redirect()->route('users.index')->with('success', 'Staff deleted successfully.');

       
    }
}
