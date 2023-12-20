<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Customer;
use App\Models\User;
use App\Models\Flight;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\Log;
use App\Mail\BookingReceipt;
use Illuminate\Support\Facades\Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;




use App\Notifications\BookingSuccessful;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('bookingID', 'like', '%' . $searchTerm . '%')
                  ->orWhere('tourCode', 'like', '%' . $searchTerm . '%')
                  ->orWhere('customerID', 'like', '%' . $searchTerm . '%');
        }
        
        $bookings = $query->get();  // Use get() instead of paginate()
        
        return view('pages.booking', compact('bookings'));
    }

    public function create(string $id){

        $tour = Tour::where('tourCode', $id)->first();

        $package = Package::where('packageID', $tour->packageID)->first();

    
        $flight = Flight::where('flightID', $tour->flightID)->first();
    
        return view('booking', compact('flight', 'tour','package'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $noOfPax = $request->noOfAdult + $request->noOfChild;

        if($request->noOfAdult == 0){
            return redirect()->back()->with('error', 'You are not allowed to travel without adult.');

        }

        if($request->noOfInfant > 3){
            return redirect()->back()->with('error', 'If you have more infant(s). Please state the number of infant at the remarks. Maximum only 3 infants per booking.');

        }

        if($noOfPax > 12){
            return redirect()->back()->with('error', 'Only a maximun 12 pax of adults and children per booking (Adults + Children).');
        }

        if($request->noOfChild > 6 && $request->noOfAdult == 1){
            return redirect()->back()->with('error', 'You are not allowed to bring more than 6 children ALONE.');

        }

        // if($request->input('noOfRoom.Single Room') == 0 && $request->input('noOfRoom.Double Room') == 0 && $request->input('noOfRoom.Triple Room') == 0){
        //     return redirect()->back()->with('error', 'Impossible you stay without room');

        // }

        // if ($request->noOfAdult == 1 && $request->noOfChild <= 1) {
        //    if($request->input('noOfRoom.Single Room') > 1 || $request->input('noOfRoom.Double Room') > 0 ||  $request->input('noOfRoom.Triple Room') > 0)
        //     return redirect()->back()->with('error', '1 adult or 1 adult with child can only choose single room');
        // }elseif($request->noOfAdult == 1 && $request->noOfChild <= 3){
        //     if($request->input('noOfRoom.Double Room') != 1 || $request->input('noOfRoom.Single Room') > 0 || $request->input('noOfRoom.Triple Room') > 0){
        //         return redirect()->back()->with('error', '1 adult and 2 children can only choose double room. If you have more children, please state in remark. ');

        //     }

        // }

        // if($request->noOfAdult == 2  && $request->noOfChild <= 2){
        //     if($request->input('noOfRoom.Double Room') != 1 || $request->input('noOfRoom.Single Room') > 0 || $request->input('noOfRoom.Triple Room') > 0 ){
        //         if($request->input('noOfRoom.Single Room') != 2 || $request->input('noOfRoom.Double Room') > 0 || $request->input('noOfRoom.Triple Room') > 0 ){
        //             return redirect()->back()->with('error', '2 adults or 1 adult with below 2 children can only choose 1 double room or 2 single room');
        //         }

        //     }
            
        // }elseif($request->noOfAdult == 2 && $request->noOfChild <= 3){
        //     if($request->input('noOfRoom.Triple Room') != 1 || $request->input('noOfRoom.Single Room') > 0 || $request->input('noOfRoom.Dobule Room') > 0){
        //         return redirect()->back()->with('error', '1 adult and 2 children can only choose triple room. If you have more children, please state in remark. ');

        //     }        }



        // if($request->noOfAdult == 3  && $request->noOfChild <= 3){
        //     if(($request->input('noOfRoom.Double Room') > 1 || $request->input('noOfRoom.Single Room') > 1 ) || $request->input('noOfRoom.Triple Room') > 0){                
        //         if($request->input('noOfRoom.Triple Room') != 1 || $request->input('noOfRoom.Double Room') > 0 || $request->input('noOfRoom.Double Room') > 0){
        //             return redirect()->back()->with('error', '3 adults or 3 adults with below 3 children can only choose 1 triple room or 1 double room and 1 single room');
        //         }
        //     }
        // }elseif($request->noOfAdult == 3 && $request->noOfChild > 3){
        //     return redirect()->back()->with('error', 'Maximum only 3 children. If you have more children, please state in remark.');

        // }

        $bookingRemarks = $request->input('bookingRemarks');

        if ($bookingRemarks === null) {
            $bookingRemarks = "No remarks";

        }
        
        $tour = Tour::where('tourCode', $request->tourCode)->first();

        $bookings = Booking::where('tourCode', $tour->tourCode)->get();

        $joinedPeople = [];    

        foreach ($bookings as $booking) {
            $tourCode = $booking->tourCode;
    
            if (!isset($joinedPeople[$tourCode])) {
                $joinedPeople[$tourCode] = 0;
            }
    
            $joinedPeople[$tourCode] += $booking->noOfAdult + $booking->noOfChild;
        }

        $joinedPeopleTotal = array_sum($joinedPeople);

        $availableSeats = $tour->noOfSeats - $joinedPeopleTotal;

        if($noOfPax > $availableSeats){
            return redirect()->back()->with('error', 'Only '. $availableSeats . ' seat(s) left. If you want to book more, please contact us.');
        }


        $package = Package::where('packageID', $tour->packageID)->first();

        $totalTourAmount = $tour->tourPrice * ($request->noOfAdult + $request->noOfChild + $request->noOfInfant);
    
        $roomPrices = [
            'Single Room' => $package->singleRoom,
            'Double Room' => $package->doubleRoom,
            'Triple Room' => $package->tripleRoom,
        ];

        $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

        foreach ($request->noOfRoom as $roomType => $quantity) {
            $roomCounts[$roomType] += $quantity;
        }
    
        $noOfRooms = [];
    $typesOfRooms = [];

    for ($i = 0; $i < $roomCounts['Triple Room']; $i++) {
        $typesOfRooms[] = 'Triple Room';
    }

    for ($i = 0; $i < $roomCounts['Double Room']; $i++) {
        $typesOfRooms[] = 'Double Room';
    }

    for ($i = 0; $i < $roomCounts['Single Room']; $i++) {
        $typesOfRooms[] = 'Single Room';
    }


        $totalRoomAmount = 0;

        foreach ($roomCounts as $roomType => $quantity) {
            $noOfRooms[$roomType] = $quantity;

        }

        foreach ($typesOfRooms as $room) {
            $totalRoomAmount += $roomPrices[$room];

        }


        $totalAmount = $totalRoomAmount + $totalTourAmount;
        $deposit = 0.3 * $totalAmount;



        $customer = Customer::where('userID', auth()->user()->userID)->first();


        $bookingID = IdGenerator::generate(['table'=> 'bookings','field' => 'bookingID','length' => 6, 'prefix' => 'BK']);
        $currentDate = today();

         $booking = Booking::create([
             'bookingID' => $bookingID,
             'bookingDate' => $currentDate,
             'noOfAdult' => $request->input('noOfAdult'),
            'noOfChild' => $request->input('noOfChild'),
            'noOfInfant' => $request->input('noOfInfant'),
            'noOfRoom' => serialize($noOfRooms),
            'typesOfRoom' => serialize($typesOfRooms),
             'bookingAmount'=> $request->input('bookingAmount'),
             'bookingDeposit'=> $request->input('bookingDeposit'),
             'bookingStatus'=> "Pending Approval",
             'bookingRemarks'=> $bookingRemarks,
             'tourCode'=> $request->input('tourCode'),
             'customerID'=> $customer->customerID,
         ]);

         Mail::to(auth()->user()->email)->send(new BookingReceipt($booking));


         return redirect()->route('bookingHistory')->with('success', 'Thank you for booking with us ! Your booking is pending for approval.');    

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $booking = Booking::where('bookingID', $id)->first();

        $customer = Customer::where('customerID', $booking->customerID)->first();

        $user = User::where('userID', $customer->userID)->first();

        // Retrieve associated tours, flights, and itinerary
        $tour = Tour::where('tourCode', $booking->tourCode)->first();
    
        $flight = Flight::where('flightID', $tour->flightID)->first();
    
        $itineraries = Itinerary::where('packageID', $tour->packageID)->get();

        $package = Package::where('packageID', $tour->packageID)->first();

    
        return view('pages.viewBooking', compact('booking', 'user', 'tour','package'));
    }
    public function edit(Request $request, $id){
        $booking = Booking::where('bookingID', $id)->first();
        $customer = Customer::where('customerID', $booking->customerID)->first();

        $user = User::where('userID', $customer->userID)->first();

        // Retrieve associated tours, flights, and itinerary
        $tour = Tour::where('tourCode', $booking->tourCode)->first();
    
        $flight = Flight::where('flightID', $tour->flightID)->first();
    
        $itineraries = Itinerary::where('packageID', $tour->packageID)->get();

        $package = Package::where('packageID', $tour->packageID)->first();
        return view('pages.editBooking', compact('booking', 'user', 'tour','package'));
    }

    public function update(Request $request, string $id)
    {

        $request->validate([
            'noOfAdult' => 'required|integer|min:1',
            'noOfChild' => 'required|integer|min:0',
            'noOfInfant' => 'required|integer|min:0',
            'noOfRoom.Single Room' => 'required|integer|min:0',
            'noOfRoom.Double Room' => 'required|integer|min:0',
            'noOfRoom.Triple Room' => 'required|integer|min:0',
            'bookingRemarks' => 'required'
        ]);

        
        $tour = Tour::where('tourCode', $request->tourCode)->first();
        $package = Package::where('packageID', $tour->packageID)->first();

        $totalTourAmount = $tour->tourPrice * ($request->noOfAdult + $request->noOfChild + $request->noOfInfant);
    
        $roomPrices = [
            'Single Room' => $package->singleRoom,
            'Double Room' => $package->doubleRoom,
            'Triple Room' => $package->tripleRoom,
        ];

        $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

        foreach ($request->noOfRoom as $roomType => $quantity) {
            $roomCounts[$roomType] += $quantity;
        }
    
        $noOfRooms = [];
    $typesOfRooms = [];

    for ($i = 0; $i < $roomCounts['Triple Room']; $i++) {
        $typesOfRooms[] = 'Triple Room';
    }

    for ($i = 0; $i < $roomCounts['Double Room']; $i++) {
        $typesOfRooms[] = 'Double Room';
    }

    for ($i = 0; $i < $roomCounts['Single Room']; $i++) {
        $typesOfRooms[] = 'Single Room';
    }


        $totalRoomAmount = 0;

        foreach ($roomCounts as $roomType => $quantity) {
            $noOfRooms[$roomType] = $quantity;

        }

        foreach ($typesOfRooms as $room) {
            $totalRoomAmount += $roomPrices[$room];

        }


        $totalAmount = $totalRoomAmount + $totalTourAmount;
        $deposit = 0.3 * $totalAmount;


        Booking::where('bookingID', $id)->update([
            'noOfAdult' => $request->input('noOfAdult'),
            'noOfChild' => $request->input('noOfChild'),
            'noOfInfant' => $request->input('noOfInfant'),
            'noOfRoom' => serialize($noOfRooms),
            'typesOfRoom' => serialize($typesOfRooms),
            'bookingAmount' =>  $request->input('bookingAmount'),
            'bookingDeposit' =>$request->input('bookingDeposit'),
            'bookingRemarks' => $request->input('bookingRemarks'),

        ]);

        return redirect()->back()->with('success', 'Booking status updated successfully');    

 
    }

    
    public function updateStatus(Request $request,string $id)
    {   
        $request->validate([
            'bookingStatus' => 'required|in:Room Pending,Pending Approval,Booking Approved,Booking Rejected,Completed',
        ]);

        Booking::where('bookingID', $id)->update([
            'bookingStatus' => $request->input('bookingStatus'),
        ]);
        


        return redirect()->back()->with('success', 'Booking status updated successfully');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Booking::where('bookingID', $id)->delete();

        return redirect()->back()->with('success', 'Booking '.$id.' deleted successfully');    

    }
}
