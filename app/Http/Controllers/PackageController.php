<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\UserPreference;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

    return view('pages.viewPackage', compact('package', 'tours', 'itineraries','flightDetails','joinedPeople'));


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
        $package = Package::where('packageID', $id)->first();
        $itineraries = Itinerary::where('packageID', $id)->get();

        return view('pages.editItinerary', compact('itineraries','package'));
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
    
        $imageName = time().'.'.$request->packageImage->extension();  

        $request->packageImage->storeAs('images', $imageName, 'public'); 

        $packageID = IdGenerator::generate(['table'=> 'packages','field' => 'packageID','length' => 6, 'prefix' => 'P']);

                //create a packageID
                $package = Package::create([
                    'packageID' => $packageID,
                    'packageName' => $packageName,
                    'packageImage'=> $imageName,
                    'highlight'=> $packageHighlight,
                    'itineraryPdf'=>"no pdf",
                    'destination'=> $destination,
                    'remarks'=> $packageRemarks,
                    'singleRoom'=> $singleRoom,
                    'doubleRoom'=> $doubleRoom,
                    'tripleRoom'=> $tripleRoom,
                ]);
        
        for ($i = 0; $i < count($numberOfDays); $i++) {

            $mealsString = "no meals";

            if (!empty($meals[$i])) {
                $mealsString = implode('|', $meals[$i]);
            }


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


        return redirect()->route('packages.index')->with('success', 'Successfully added a new package.');    

       
    }

    public function updateItinerary(Request $request, $id){
        
        $numberOfDays = $request->input('noOfDays'); // This will be an array
        $remarks = $request->input('remarks'); // This will be an array
        $hotelNames = $request->input('hotelName'); // This will be an array
        $meals = $request->input('meals'); // This will be an array of arrays
        $information = $request->input('information'); // This will be an array
        for ($i = 0; $i < count($numberOfDays); $i++) {
            

            $mealsString = (array_key_exists($i, $meals) && is_array($meals[$i]))
            ? implode('|', $meals[$i])
            : "No Meal";

            Itinerary::where('packageID', $id)
            ->where('noOfDays', $i + 1) // Assuming day numbering starts from 1
            ->update([
                'remarks' => $remarks[$i],
                'hotelName' => $hotelNames[$i],
                'meals' => $mealsString,
                'information' => $information[$i],
            ]);
        }


           
         // Redirect the user back with a success message
          return redirect()->route('packages.show', $id)->with('success', 'Itinerary updated successfully!');    
    
        
    }

    public function destroy($id)
    {

        $package = Package::where('packageID', $id)->first();

        $tours = Tour::where('packageID', $id)->get();


        $package->tours()->delete();

        foreach ($tours as $tour) {

            $flightID = $tour->flightID;
           
            Flight::where('flightID', $flightID)->delete();
            
        }
        

        $package->itinerary()->delete();

        Package::where('packageID', $id)->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');

    }

    public function updateTour(Request $request, $id){
        
    $tour= Tour::where('tourCode', $id)->first();
    
    Tour::where('tourCode', $id)->update([

    'tourLanguages' => $request->input('tourLanguages'),
    'tourPrice' => $request->input('tourPrice'),
    'noOfSeats' => $request->input('noOfSeats'),
        
    ]);


       Flight::where('flightID', $tour->flightID)->update([
            'sector' => $request->input('sector'),
            'airlines' => $request->input('airlines'),
            'flightNumber' => $request->input('flightNumber'),
            'departureDate' => $request->input('departureDate'),
            'arrivalDate' => $request->input('arrivalDate'),
            'departureTime' => $request->input('departureTime'),
            'arrivalTime' => $request->input('arrivalTime'),
            'returnSector' => $request->input('returnSector'),
            'returnAirlines' => $request->input('returnAirlines'),
            'returnFlightNumber' => $request->input('returnFlightNumber'),
            'returnDepartureDate' => $request->input('returnDepartureDate'),
            'returnArrivalDate' => $request->input('returnArrivalDate'),
            'returnDepartureTime' => $request->input('returnDepartureTime'),
            'returnArrivalTime' => $request->input('returnArrivalTime'),
        ]);
    
    
     // Redirect the user back with a success message
     return redirect()->route('packages.show', $tour->packageID)->with('success', 'Tour updated successfully!');    

    }

    public function search(Request $request)
    {
        $destination = $request->input('destination');
        $date = $request->input('date');
        $sortOrder = $request->input('sort', 'price_asc'); 

        $packagesQuery = Package::query()
            ->with(['tours.flight']); // Eager load tours along with their associated flight
    
        if ($destination) {
            $packagesQuery->where('destination', 'like', '%' . $destination . '%');
        }
    
        if ($date) {
            $packagesQuery->whereHas('tours.flight', function ($flightQuery) use ($date) {
                $formattedDate = Carbon::createFromFormat('Y-m', $date);
                $flightQuery->whereYear('departureDate', $formattedDate->year)
                ->whereMonth('departureDate', $formattedDate->month);            });
        }
    


        $packages = $packagesQuery->get();
        $allTours = $packages->flatMap->tours;

   
        $minTourPrices = $allTours->groupBy('packageID')->map(function ($tours) {
            return $tours->min('tourPrice');
        });



        $packages = $this->sortPackages($packages, $minTourPrices, $sortOrder);

    
        

        $departureDates = $allTours->flatMap(function ($tour) {
            return [$tour->flight->flightID => $tour->flight->departureDate];
        });
    
        return view('packages', compact('packages', 'allTours', 'departureDates','minTourPrices'));
    }

    private function sortPackages($packages, $minTourPrices, $sortOrder)
{
    return $packages->sortBy(function ($package) use ($minTourPrices) {
        return $minTourPrices[$package->packageID];
    }, null, $sortOrder === 'price_desc');
}


    public function updatePackage(Request $request, $id){

        $request->validate([
            'packageImage' => 'image'
            ]);

        $package = Package::where('packageID', $id)->first();

      
        if($request->packageImage != null && ($request->packageImage !== $package->packageImage)){

            $imageName = time().'.'.$request->packageImage->extension();  

            $request->packageImage->storeAs('images', $imageName, 'public');

            Package::where('packageID', $id)->update([
                'packageName' => $request->input('packageName'),
                'packageImage' => $imageName,
                'destination' => $request->input('destination'),
                'highlight' => $request->input('packageHighlight'),
                'singleRoom' => $request->input('singleRoom'),
                'doubleRoom' => $request->input('doubleRoom'),
                'tripleRoom' => $request->input('tripleRoom'),
                'remarks' => $request->input('packageRemarks'),
            ]); 
        
        }else{
            Package::where('packageID', $id)->update([
                'packageName' => $request->input('packageName'),
                'destination' => $request->input('destination'),
                'highlight' => $request->input('packageHighlight'),
                'singleRoom' => $request->input('singleRoom'),
                'doubleRoom' => $request->input('doubleRoom'),
                'tripleRoom' => $request->input('tripleRoom'),
                'remarks' => $request->input('packageRemarks'),
            ]);

        }
        
        // Redirect back to the show page with a success message
        return redirect()->route('packages.show', $id)->with('success', 'Package updated successfully!');    }



        
        public function displayTrendingPackage(Request $request)
        {

        
            if (auth()->check() && auth()->user()->userID != null && auth()->user()->role == "customer" ) {

                $userPreference = UserPreference::where('userID', auth()->user()->userID)->first();

                if(empty($userPreference)){
                    return view('userPreferences');
                }
                
                $response = Http::post('http://127.0.0.1:5000/recommend', [
                    'season' => $userPreference->season,
                    'activity' => $userPreference->activity,
                    'accomodation' => $userPreference->accomodation,
                    'destination' => $userPreference->destination,
                    'travelGroup' => $userPreference->travelGroup,
                ]);

    
            // Check if the request was successful
            if ($response->successful()) {
                // Decode the JSON response
                $recommendations = $response->json()['recommendations'];

                $allPackages = [];
                    foreach ($recommendations as $recommendation) {
                        $allIds[] = $recommendation['id'];
                    }

                    $allTours = DB::table('tours')
                    ->whereIn('packageID', $allIds)
                    ->select('packageID', 'tourCode', 'tourPrice', 'flightID')
                    ->get()
                    ->groupBy('packageID');
            
                $packages = Package::whereIn('packageID', $allIds)->get();

                return view('homePage', compact('packages', 'allTours'));             

            } else {
                // Handle the error
                return response()->json(['error' => 'Failed to get recommendations'], $response->status());
            }
    
            }else{

                $query = Package::query();

                if ($request->has('search')) {
                    $searchTerm = $request->input('search');
                    $query->where('packageID', 'like', '%' . $searchTerm . '%')
                        ->orWhere('packageName', 'like', '%' . $searchTerm . '%')
                        ->orWhere('destination', 'like', '%' . $searchTerm . '%');
                }
            
                $packages = $query->paginate(3);
                $packageIds = $packages->pluck('packageID')->toArray();
                
                $allTours = DB::table('tours')
                    ->whereIn('packageID', $packageIds)
                    ->select('packageID', 'tourCode', 'tourPrice', 'flightID')
                    ->get()
                    ->groupBy('packageID');
            
            
                return view('homePage', compact('packages', 'allTours'));

            }
            

        }







        public function generateItinerary(Request $request, $id){
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
        
            return view('pages.generateItinerary', compact('package', 'tours', 'itineraries','flightDetails'));
        }



    }



    