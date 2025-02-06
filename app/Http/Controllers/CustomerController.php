<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()
        ->select('users.name', 'users.email', 'users.phoneNo','users.gender','users.address','users.nationality','users.identityNo','customers.titles', 
        'customers.customerID', 'customers.titles','customers.remarks','passports.passportNo','passports.passportImage' 
        ,'passports.expiryDate', 'beneficiary.benName', 'beneficiary.benID','beneficiary.benIC','beneficiary.benRelationship','beneficiary.benContact','beneficiary.benAddress',
        'beneficiary.benRelationship')
        ->leftJoin('customers', 'users.userID', '=', 'customers.userID')
        ->leftJoin('beneficiary', 'customers.customerID', '=', 'beneficiary.customerID')
        ->leftJoin('passports', 'customers.customerID', '=', 'passports.customerID')
        ->whereIn('users.role', ['customer']);

    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        
        $query->where(function ($q) use ($searchTerm) {
            $q->where('users.name', 'like', '%' . $searchTerm . '%')
              ->orWhere('users.email', 'like', '%' . $searchTerm . '%');
        });
    }

    $users = $query->paginate(10);

    return view('users.customers', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
