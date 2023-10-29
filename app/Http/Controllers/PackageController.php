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
                'airlines' => $noOfSeats[$i],
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
}
