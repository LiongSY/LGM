<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use App\Models\Log;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class ItineraryController extends Controller
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
        //
    }

    public function displayItineraries (Request $request, $id)
    {

        $package = Package::where('packageID', $id)->first();
        $tours = Tour::where('packageID',$id)->get();
        $flightDetails =[];

        foreach($tours as $tour){
            $flight = Flight::where('flightID', $tour->flightID)->first();

            $flightDetails[]=$flight;
        }

        $joinedPeople = [];    
        foreach ($tours as $tour) {
            $flight = Flight::where('flightID', $tour->flightID)->first();
    
            $flightDetails[] = $flight;
    
    
            $bookings = Booking::where('tourCode', $tour->tourCode)->get();
    

        
            foreach ($bookings as $booking) {
                $tourCode = $booking->tourCode;
        
                if (!isset($joinedPeople[$tourCode])) {
                    $joinedPeople[$tourCode] = 0;
                }
        
                $joinedPeople[$tourCode] += $booking->noOfAdult + $booking->noOfChild;
            }
            
        }

        $itineraries = Itinerary::where('packageID', $id)->get();


        return view('itineraries', compact('package', 'tours', 'itineraries', 'flightDetails','joinedPeople'));

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
