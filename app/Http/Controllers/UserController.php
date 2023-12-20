<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */

     public function index(Request $request)
{
    
    $query = User::query()
        ->select('users.*', 'staff.lastSeen', 'staff.status','staff.staffID') 
        ->leftJoin('staff', 'users.userID', '=', 'staff.userID')
        ->whereIn('users.role', ['staff']);


    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        
        // Apply search conditions for users table
        $query->where(function ($q) use ($searchTerm) {
            $q->where('users.name', 'like', '%' . $searchTerm . '%')
              ->orWhere('users.email', 'like', '%' . $searchTerm . '%');
        });
    }

    $users = $query->paginate(10);

    // Return the paginated users (and staff) data to the view
    return view('users.index', compact('users'));
}

     
}
