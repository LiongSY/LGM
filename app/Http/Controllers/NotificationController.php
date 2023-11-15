<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function bookingCompleted(Request $request){
        $deposit = Booking::create([
            
            'userID' =>Auth::user()->userID,
        ]);
        User::find(Auth::user()->userID)->notify(new Notification($deposit->amount));
    
        return redirect()->back()->with('status','Your deposit was successful!');
    }

    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }


}
