<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\User;

class BookingHistoryController extends Controller
{
    public function index()
    {

        // Check if the authenticated user has a role and the role is 'customer'
            // Fetch booking history for the logged-in customer
            if(empty(auth()->user()->userID)){
                return view('auth/login');
                

            }
            $customer = Customer::where('userID', auth()->user()->userID)->first();

            if ($customer) {
                $bookings = Booking::where('customerID', $customer->customerID)->get();
                return view('bookingHistory', compact('bookings'));
            } 
      
    }
}
