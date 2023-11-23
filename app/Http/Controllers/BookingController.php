<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Customer;
use App\Models\User;
use App\Models\Flight;
use App\Models\Itinerary;
use App\Models\Package;




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
    
        $bookings = $query->paginate(10); 
        return view('pages.booking', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $customer = Customer::where('userID', $loggedInUser->userID)->first();


        // $bookingID = IdGenerator::generate(['table'=> 'bookings','field' => 'bookingID','length' => 6, 'prefix' => 'BK']);
        // $currentDate = today();

        //  $booking = Booking::create([
        //      'bookingID' => $bookingID,
        //      'bookingDate' => $currentDate,
        //      'noOfAdult'=> $this->bookingData['noOfAdult'],
        //      'noOfChild'=> $this->bookingData['noOfChild'],
        //      'noOfInfant'=>$this->bookingData['noOfInfant'],
        //      'noOfRoom'=> $this->bookingData['noOfRoom'],
        //      'typesOfRoom'=> $this->bookingData['typesOfRoom'],
        //      'bookingAmount'=> $this->bookingData['bookingAmount'],
        //      'bookingDeposit'=> $this->bookingData['bookingDeposit'],
        //      'bookingStatus'=> $this->bookingData['bookingStatus'],
        //      'bookingRemarks'=> $this->bookingData['bookingRemarks'],
        //      'tourCode'=> $this->bookingData['tourCode'],
        //      'customerID'=> $customer->customerID,
        //  ]);

        //  User::find(Auth::user()->id)->notify(new BookingSuccessful($booking->bookingID));

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

        return view('pages.editBooking', compact('booking'));
    }

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
