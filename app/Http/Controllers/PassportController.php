<?php

namespace App\Http\Controllers;

use App\Models\Passport;
use Illuminate\Http\Request;

class PassportController extends Controller
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

        $imageName = time().'.'.$request->passportImage->extension();  

        $request->passportImage->storeAs('images', $imageName, 'public'); 

        Passport::create([
            'passportNo' => $request->passportNo,
            'passportImage' => $imageName,
            'expiryDate' => $request->expiryDate,
            'customerID' => $request->customerID,
        ]);

        return redirect()->back()->with('success', 'Passport added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($passportNo){
    $passport = Passport::where('passportNo', $passportNo)->first();

    return view('pages.editPassport', compact('passport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
        'passportNo' => 'required|alpha_num', 
        'expiryDate' => 'required|date|after_or_equal:today', 
        'passportImage' => 'image'
        ]);


        $passport = Passport::where('passportNo', $id)->first();

        if($request->passportImage != null && ($request->passportImage !== $passport->passportImage)){

            $imageName = time().'.'.$request->passportImage->extension();  

            $request->passportImage->storeAs('images', $imageName, 'public');

            Passport::where('passportNo', $id)->update([
                'passportNo' => $request->passportNo,
                'expiryDate' => $request->expiryDate,
                'passportImage' => $imageName,
            ]);    
        
        }else{
            Passport::where('passportNo', $id)->update([
                'passportNo' => $request->passportNo,
                'expiryDate' => $request->expiryDate,
                'passportImage' => $passport->passportImage,
            ]); 

        }

  
        
        return redirect()->route('users.customers')->with('success', 'Passport updated successfully!');    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
