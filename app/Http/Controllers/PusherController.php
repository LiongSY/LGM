<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Staff;
use App\Events\PusherBroadcast;
use Illuminate\Support\Facades\Log; 

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
        $customerConversation = Conversation::all();
    
        $customerIDs = $customerConversation->pluck('userID')->unique();
    
        $customerList = User::whereIn('userID', $customerIDs)->get();
    
        return view('pages.dashboard', compact('customerList'));
    }
    
    // public function liveChat(string $id)
    // {

    //     $customerConversation = Conversation::all();

    //     $customerList = [];

    //     foreach($customerConversation as $conversation){

    //         $customerList[] = $conversation;
    //     }

    //     return view('pages.dashboard', compact('customerConversation','customerList'));
    // }

    public function broadcast(Request $request)
    {
        $user = auth()->user();
        $sender = "staff";
        $message = new Message();
        $newConversation = Conversation::where('userID', $user->userID)->first();

        if ($user->role == 'customer') {
    
            Log::info( $newConversation);
            if (!$newConversation) {
                $newConversation = new Conversation();
                $newConversation->userID = $user->userID;
                $newConversation->save();
            }
            $user = auth()->user();

            $sender = $user->userID;
        }

        $conversationID = $request->get('conversationID');
        if($request->get('conversationID') == 0){
        $conversationID = $newConversation->userID;

        }

        $message->userID = $conversationID;
        $message->sender = $sender;
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
    public function show(int $userID)
    {



        $user = User::where('userID', $userID)->first();



        return view('chat.index', compact('user'));


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
