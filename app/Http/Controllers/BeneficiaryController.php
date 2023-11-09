<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $benID = IdGenerator::generate(['table'=> 'beneficiary','field' => 'benID','length' => 6, 'prefix' => 'BEN']);

       Beneficiary::create([
        "benID"=> $benID,
        "benName"=>$request->benName,
        "benTitle"=> $request->benTitle,
        "benIC"=> $request->benIC,
        "benRelationship"=> $request->benRelationship,
        "benContact"=> $request->benContact,
        "benAddress"=> $request->benAddress,
        "customerID"=> $request->customerID,

       ]);


        return redirect()->back()->with('success', 'Beneficiary added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($benID){
        $beneficiary = Beneficiary::where('benID', $benID)->first();
    
        return view('pages.editBeneficiary', compact('beneficiary'));
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $customMessages = [
                'benName.regex' => 'The name field should only contain letters.',
                'benIC.regex' => 'The IC number must be in the format XXXXXX-XX-XXXX.',
                'benRelationship.regex' => 'The relationship field should only contain letters.',
                'benContact.regex' => 'The contact number should only contain numbers, +, or -.',
                'benAddress.max' => 'The address field cannot be more than 150 characters.',
            ];
            $request->validate([
                'benTitle' => 'required',
                'benName' => 'required|regex:/^[a-zA-Z\s]+$/',
                'benIC' => 'required|regex:/^\d{6}-\d{2}-\d{4}$/',
                'benRelationship' => 'required|regex:/^[a-zA-Z]+$/',
                'benContact' => 'required|regex:/^[0-9\-\+]+$/',
                'benAddress' => 'required|string|max:150',
            ], $customMessages);
    

                Beneficiary::where('benID', $id)->update([
                'benID' => $request->benID,
                'benTitle' => $request->benTitle,
                'benName' =>$request->benName,
                'benIC' => $request->benIC,
                'benRelationship' => $request->benRelationship,
                'benContact' => $request->benContact,
                'benAddress' => $request->benAddress                
            ]); 
    
            
    
      
            
            return redirect()->route('users.customers')->with('success', 'Beneficiary updated successfully!');    
    
        }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
