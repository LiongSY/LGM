<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\Tour;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
{
    
    $query = Package::query();
    
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where('packageID', 'like', '%' . $searchTerm . '%')
              ->orWhere('packageName', 'like', '%' . $searchTerm . '%')
              ->orWhere('destination', 'like', '%' . $searchTerm . '%');
    }

    $packages = $query->paginate(10); 
    return view('pages.package', compact('packages'));
}

    public function show(Request $request, $id){
        
    $package = Package::where('packageID', $id)->first();

    // Retrieve associated tours, flights, and itinerary
    $tours = Tour::where('packageID', $id)->get();

    // Array to store flight details
    $flightDetails = [];

    foreach ($tours as $tour) {
        $flight = Flight::where('flightID', $tour->flightID)->first();

        $flightDetails[] = $flight;
    }

    $itineraries = Itinerary::where('packageID', $id)->get();

    return view('pages.viewPackage', compact('package', 'tours', 'itineraries','flightDetails'));


    }


    public function editPackage(Request $request, $id){
        $package = Package::where('packageID', $id)->first();

        return view('pages.editPackage', compact('package'));
    }

    public function editTour(Request $request, $id){
        $tour = Tour::where('tourCode', $id)->first();


            $flight = Flight::where('flightID', $tour->flightID)->first();
    
        

        return view('pages.editTour', compact('tour', 'flight'));
    }

    public function editItinerary(Request $request, $id){
        $itineraries = Itinerary::where('packageID', $id)->get();

        return view('pages.editItinerary', compact('itineraries'));
    }

    
    public function create(){
        return view('pages.createPackage');
    }

    public function store(Request $request)
    {
        //packages
        $packageName = $request->input('packageName');
        $packageHighlight = $request->input('packageHighlight');
        $destination = $request->input('destination');
        $packageRemarks = $request->input('packageRemarks');
        $singleRoom = $request->input('singleRoom');
        $doubleRoom = $request->input('doubleRoom');
        $tripleRoom = $request->input('tripleRoom');
        //tour
        $sectors = $request->input('sector');
        $airlines = $request->input('airlines');
        $flightNumbers = $request->input('flightNumber');
        $departureDates = $request->input('departureDate');
        $arrivalDates = $request->input('arrivalDate');
        $departureTimes = $request->input('departureTime');
        $arrivalTimes = $request->input('arrivalTime');
        $returnSectors = $request->input('returnSector');
        $returnAirlines = $request->input('returnAirlines');
        $returnFlightNumbers = $request->input('returnFlightNumber');
        $returnDepartureDates = $request->input('returnDepartureDate');
        $returnArrivalDates = $request->input('returnArrivalDate');
        $returnDepartureTimes = $request->input('returnDepartureTime');
        $returnArrivalTimes = $request->input('returnArrivalTime');
        $tourLanguages = $request->input('tourLanguages');
        $tourPrices = $request->input('tourPrice');
        $noOfSeats = $request->input('noOfSeats');
        //itinerary
        $numberOfDays = $request->input('noOfDays'); // This will be an array
        $remarks = $request->input('remarks'); // This will be an array
        $hotelNames = $request->input('hotelName'); // This will be an array
        $meals = $request->input('meals'); // This will be an array of arrays
        $information = $request->input('information'); // This will be an array
    
        $packageID = IdGenerator::generate(['table'=> 'packages','field' => 'packageID','length' => 6, 'prefix' => 'P']);

                //create a packageID
                $package = Package::create([
                    'packageID' => $packageID,
                    'packageName' => $packageName,
                    'packageImage'=> "no image",
                    'highlight'=> $packageHighlight,
                    'itineraryPdf'=>"no pdf",
                    'destination'=> $destination,
                    'remarks'=> $packageRemarks,
                    'singleRoom'=> $singleRoom,
                    'doubleRoom'=> $doubleRoom,
                    'tripleRoom'=> $tripleRoom,
                ]);
        
        for ($i = 0; $i < count($numberOfDays); $i++) {

            $mealsString = implode('|', $meals[$i]);


            Itinerary::create([
            'packageID'=> $packageID,
            'noOfDays'=> $numberOfDays[$i],
            'meals'=>$mealsString,
            'hotelName'=>$hotelNames[$i],
            'information'=>$information[$i],
            'remarks'=>$remarks[$i]

        ]);        
        }

        for ($i = 0; $i < count($departureDates); $i++) {
            $flightID[$i] = IdGenerator::generate(['table'=> 'flights','field' => 'flightID','length' => 6, 'prefix' => 'F']);
            Flight::create([
                'flightID' => $flightID[$i] ,
                'departureDate' => $departureDates[$i],
                'arrivalDate' => $arrivalDates[$i],
                'sector' => $sectors[$i],
                'airlines' => $airlines[$i],
                'flightNumber'=> $flightNumbers[$i],
                'departureTime'=> $departureTimes[$i],
                'arrivalTime'=> $arrivalTimes[$i],
                'returnSector'=>$returnSectors[$i],
                'returnAirlines'=>$returnAirlines[$i],
                'returnFlightNumber'=>$returnFlightNumbers[$i],
                'returnDepartureDate'=>$returnDepartureDates[$i],
                'returnArrivalDate'=> $returnArrivalDates[$i],
                'returnDepartureTime'=>$returnDepartureTimes[$i],
                'returnArrivalTime'=>$returnArrivalTimes[$i]
            ]);

            $tourCode[$i] = IdGenerator::generate(['table'=> 'tours','field' => 'tourCode','length' => 7, 'prefix' => 'LGMT']);

            Tour::create([
                'tourCode' => $tourCode[$i],
                'tourLanguages' => $tourLanguages[$i],
                'tourPrice' => $tourPrices[$i],
                'tourStatus' => "Book Now",
                'noOfSeats' =>$noOfSeats[$i],
                'flightID'=> $flightID[$i],
                'packageID' => $packageID 
            ]);


        }



       
    }

    public function updateTour(Request $request, $id){
    // Retrieve associated tours, flights, and itinerary
    $tours = Tour::where('tourCode', $id)->get();

    foreach ($tours as $index => $tour) {

        
    $tour->update([

    'tour_languages' => $request->input('tourLanguages'),
    'tour_price' => $request->input('tourPrice'),
    'no_of_seats' => $request->input('noOfSeats'),
        
    ]);


        $flight = Flight::where('flightID', $tour->flightID)->first();
        $flight->update([
            'sector' => $request->input('sector')[$index],
            'airlines' => $request->input('airlines')[$index],
            'flightNumber' => $request->input('flightNumber')[$index],
            'departureDate' => $request->input('departureDate')[$index],
            'arrivalDate' => $request->input('arrivalDate')[$index],
            'departureTime' => $request->input('departureTime')[$index],
            'arrivalTime' => $request->input('arrivalTime')[$index],
            'returnSector' => $request->input('returnSector')[$index],
            'returnAirlines' => $request->input('returnAirlines')[$index],
            'returnFlightNumber' => $request->input('returnFlightNumber')[$index],
            'returnDepartureDate' => $request->input('returnDepartureDate')[$index],
            'returnArrivalDate' => $request->input('returnArrivalDate')[$index],
            'returnDepartureTime' => $request->input('returnDepartureTime')[$index],
            'returnArrivalTime' => $request->input('returnArrivalTime')[$index],
            // Update other flight fields if needed
        ]);
    }
    
     // Redirect the user back with a success message
     return redirect()->route('packages.show', $id)->with('success', 'Package updated successfully!');    

    }


    public function updatePackage(Request $request, $id){
        // Find the package by ID
        Package::where('packageID', $id)->update([
            'packageName' => $request->input('packageName'),
            'destination' => $request->input('destination'),
            'highlight' => $request->input('packageHighlight'),
            'singleRoom' => $request->input('singleRoom'),
            'doubleRoom' => $request->input('doubleRoom'),
            'tripleRoom' => $request->input('tripleRoom'),
            'remarks' => $request->input('packageRemarks'),
        ]);
        // Redirect back to the show page with a success message
        return redirect()->route('packages.show', $id)->with('success', 'Package updated successfully!');    }
}
