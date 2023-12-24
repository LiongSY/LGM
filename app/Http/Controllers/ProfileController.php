<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {

        //Custom validation message
        $customMessages = [
            'name.regex' => 'The name field should only contain letters.',
            'identityNo.regex' => 'The IC number must be in the format XXXXXX-XX-XXXX.',
            'nationality.regex' => 'Nationality field should only contain letters.',
            'benContact.regex' => 'The contact number should be xxx-xxxxxxx',
        ];
    
        //Input validation
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'phoneNo' => ['required', 'regex:/^(01)[0-9]-*[0-9]{7,8}$/'],
            'nationality' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/'],
            'identityNo' => ['required', 'regex:/^\d{6}-\d{2}-\d{4}$/'],
            'gender' => 'required',
            'address' => 'required',
        ], $customMessages);
    
        $user = auth()->user();
        $user->update($request->all());
    
        //Check if the user is a male or female
        $title = $user->gender === 'Male' ? 'Mr.' : 'Ms.';
    
        //Store the title
        Customer::where('userID', $user->userID)->update(['titles' => $title]);

        //Return back with successful message
         return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
