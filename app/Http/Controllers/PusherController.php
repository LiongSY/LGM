<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Staff;
use App\Events\PusherBroadcast;
class PusherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
    //     $user = auth()->user();

    //     if ($user->role == 'staff') {
    //         $customers = User::where('role', 'customer')->get();
    //         $staff = Staff::where('userID',$user->userID)->first();
    //         $selectedCustomerId = $request->input('customerID');
    //         if ($selectedCustomerId) {
    //             $selectedCustomer = Customer::where('customerID', $selectedCustomerId)->first();
    //             $customerMessages = Message::where('staffID', $staff->staffID)
    //                 ->where('customerID', $selectedCustomer->customerID)
    //                 ->get();

    //             return view('chat.index', compact('customers', 'customerMessages', 'selectedCustomer'));
    //         }

    //         return view('chat.index', compact('customers'));
    //     } else {
    //         $staff = User::where('role', 'staff')->first();
    //         $customer = Customer::where('userID',$user->userID)->first();

    //         $staffMessages = Message::where('customerID', $customer->customerID)->get();
    //         return view('chat.index', compact('staffMessages'));
    //     }
    // }

    public function index()
    {
        return view('chat/index');
    }

    public function broadcast(Request $request)
    {
        $user = auth()->user();

        $message = new Message();

        $message->userID = $user->userID;
        $message->message = $request->get('message');
        $message->save();
        
       
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();


        return view('broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
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
