<?php


namespace App\Conversations;
use App\Mail\BookingReceipt;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\BotManController;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Log;
use App\Models\Itinerary;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Tour;
use App\Conversations\MenuConversation;
use BotMan\BotMan\Messages\Conversations\Conversation;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
class BookingConversation extends Conversation
{
    protected $bookingData;
    protected $roomConfigurations = [
        'Single Room' => ['adults' => 1, 'children' => 0],
        'Double Room' => ['adults' => 2, 'children' => 1, 'maxChildren' => 2],
        'Triple Room' => ['adults' => 3, 'children' => 2, 'maxChildren' => 3],
    ];

    
    public function run()
    {
        $this->askTourCode();
    }

    public function askTourCode()
    {
        // Ask the user to input the tour code
        $this->ask('Thanks, which tour do you want to book? (Please insert the tour code.)', function ($answer) {
            // Store the user's input (tour code) in the booking data
            $this->bookingData['tourCode'] = strtoupper($answer->getText());
    
            // Retrieve tour details based on the provided tour code
            $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();
    
            // Check if the tour with the specified code exists
            if ($tour) {
                // Retrieve existing bookings for the specified tour
                $bookings = Booking::where('tourCode', $this->bookingData['tourCode'])->get();
    
                $joinedPeople = [];
    
                // Calculate the total number of joined people for the specified tour
                foreach ($bookings as $booking) {
                    $tourCode = $booking->tourCode;
    
                    if (!isset($joinedPeople[$tourCode])) {
                        $joinedPeople[$tourCode] = 0;
                    }
    
                    $joinedPeople[$tourCode] += $booking->noOfAdult + $booking->noOfChild;
                }
    
                $joinedPeopleTotal = array_sum($joinedPeople);
    
                // Calculate the available seats for the specified tour
                $availableSeats = $tour->noOfSeats - $joinedPeopleTotal;
    
                // Check if there are available seats
                if ($availableSeats < 1) {
                    // Inform the user that the tour is full
                    $this->repeat('We are sorry! The tour is <span style="color:red">FULL</span>!<br>Please contact us at 087-453888 or choose another tour.');
                } else {
                    $today = Carbon::now();
    
                    // Check if the tour's departure date is in the future
                    if ($tour->flight->departureDate > $today) {
                        // Store additional booking data
                        $this->bookingData['availableSeats'] = $availableSeats;
                        $package = Package::where('packageID', $tour->packageID)->first();
                        $this->bookingData['packageID'] = $package->packageID;
                        $flight = Flight::where('flightID', $tour->flightID)->first();
    
                        // Display tour details to the user
                        $this->say('Great!<br>Please check the tour details:<br><br>' . 'Package: ' . $package->packageName . '<br>Tour: ' . $tour->tourCode . '<br>Tour Price: RM' . $tour->tourPrice . '/pax' . '<br>Departure Date: ' . $flight->departureDate . '<br><br>Insert NO if you want to reselect.<br><br><p style="color:red"> There are ' . $availableSeats . ' seat(s) left.');
                        
                        // Proceed to ask the user for the number of people for the booking
                        $this->askNumberOfPeople();
                    } else {
                        // Inform the user that the tour is not available anymore
                        $this->repeat('Tour is not available anymore!<br>Please check the tour code from the DEPARTURE DATE tab in the package and insert again.');
                    }
                }
            } else {
                // Inform the user that the specified tour code is not available
                $this->repeat('Tour is not available!<br>Please check the tour code from the DEPARTURE DATE tab in the package and insert again.');
            }
        });
    }
    public function askNumberOfPeople()
    {
        $this->ask('How many adults will be joining?', function ($answer) {
            $noOfAdult = strtoupper($answer->getText());
            if ($noOfAdult>0 && $noOfAdult < 13 && is_numeric($noOfAdult) && $noOfAdult <= $this->bookingData['availableSeats']) {
                $this->bookingData['noOfAdult'] = $noOfAdult;
                $newAvailableSeats = $this->bookingData['availableSeats'] - $this->bookingData['noOfAdult'];

                
                $this->ask('How many children will be joining?', function ($answer) use ($newAvailableSeats,$noOfAdult){
                    $this->bookingData['noOfChild'] = $answer->getText();


                    if (is_numeric($this->bookingData['noOfChild']) && $this->bookingData['noOfChild'] >= 0 && $this->bookingData['noOfChild'] < 13 && $this->bookingData['noOfChild'] <= $newAvailableSeats ) {


                            $this->ask('How many infants will be joining?', function ($answer) {
                                $this->bookingData['noOfInfant'] = $answer->getText();
    
                                if (is_numeric($this->bookingData['noOfInfant']) && $this->bookingData['noOfInfant'] >= 0 && $this->bookingData['noOfInfant'] < 4) {
                                    $this->askRoomSelection();
    
                                }  elseif(!is_numeric($this->bookingData['noOfInfant'])) {
                                    $this->repeat('I don\'t understand "'.$this->bookingData['noOfInfant'].'" .<br> Please only insert the number of infant in (digit).');
                                }elseif($this->bookingData['noOfInfant']<0){
                                    $this->repeat('Your input cannot lower than 0.<br> Please insert 0 for no infant. ');
                                }
                                elseif($this->bookingData['noOfInfant']>3){
                                    $this->repeat('No of infant cannot more than 3 in a booking.<br> If you have more infant, please state the number in the remarks.');
                                }
                                else {
                                    $this->repeat('I don\'t understand "'.$this->bookingData['noOfInfant'].'" .<br> Please only insert the number of infant in (digit).');
                                }
                            });
                      
                    }elseif(!is_numeric($this->bookingData['noOfChild'])){
                        $this->repeat('I don\'t understand "'.$this->bookingData['noOfChild'].'" .<br> Please only insert the number of children in (digit).');
                    }elseif(($noOfAdult+$this->bookingData['noOfChild'])>12){
                        $this->repeat('Only a maximum of 12 person are allowed for each booking.');
                    }elseif($this->bookingData['noOfChild'] > $newAvailableSeats){
                        $this->repeat('We are sorry ! There are only '. $newAvailableSeats. ' seat(s) left.');
                    }elseif($this->bookingData['noOfChild']<0){
                        $this->repeat('Your input cannot lower than 0.<br> Please insert 0 for no children. ');
                    }
                    else {
                        $this->repeat('I don\'t understand "'.$this->bookingData['noOfChild'].'" .<br> Please only insert the number of children in (digit).');
                    }
                });
            }elseif(strtoupper($noOfAdult) === 'NO'){
                $this->askTourCode();
            }elseif(!is_numeric($noOfAdult)) {
                $this->repeat('Please insert the number of adults or NO to reselect the tour.');
            }elseif($noOfAdult>$this->bookingData['availableSeats']){
                $this->repeat('We are sorry ! There are only '. $this->bookingData['availableSeats']. ' seat(s) left.');
            
            }elseif($noOfAdult > 12 &&  $noOfAdult <= $this->bookingData['availableSeats']){
                $this->repeat('Only a maximum of 12 person are allowed for each booking.');
            }elseif($noOfAdult <= 0){
                $this->repeat('Must have atleast 1 adult to join the tour!');
            }else{
                $this->say('Invalid number of adults. Please try again.');
                $this->askNumberOfPeople();
            } 


        });
    }

    public function askRoomSelection()
    {

        $suitableRooms = $this->getSuitableRooms($this->bookingData['noOfAdult'], $this->bookingData['noOfChild'], $this->bookingData['noOfInfant']);

        $noOfRooms = $this->displayRoom($suitableRooms);


        $this->ask('Are you ok with the room suggested? (YES/NO)', function ($answer) use ($suitableRooms,$noOfRooms) {
            $roomAns = strtoupper($answer->getText());

            if ($roomAns === 'YES') {
                $this->bookingData['bookingStatus'] = "Pending Approval";
                $this->bookingData['typesOfRoom'] = serialize($suitableRooms);
                $this->bookingData['noOfRoom'] = serialize($noOfRooms);
                $this->calculateTotalAmount($suitableRooms);
                $this->askRemarks($suitableRooms);
            } else if($roomAns === 'NO'){
                $suitableRooms = $this->alternativeRooms($this->bookingData['noOfAdult'], $this->bookingData['noOfChild'], $this->bookingData['noOfInfant']);
                $noOfRooms = $this->displayRoom($suitableRooms);
                
                $this->ask('Are you ok with the NEW room suggested? (YES/NO)', function ($answer) use ($suitableRooms, $noOfRooms) {
                    $newRoomAns = strtoupper($answer->getText());
        
                    if ($newRoomAns === 'YES') {
                        $this->bookingData['bookingStatus'] = "Pending Approval";
                        $this->bookingData['typesOfRoom'] = serialize($suitableRooms);
                        $this->bookingData['noOfRoom'] = serialize($noOfRooms);
                        $this->calculateTotalAmount($suitableRooms);
                        $this->askRemarks($suitableRooms);
                    } else if($newRoomAns === 'NO'){
                        $this->bookingData['bookingStatus'] = "Room Pending";
                        $this->bookingData['typesOfRoom'] = serialize($suitableRooms);
                        $this->bookingData['noOfRoom'] = serialize($noOfRooms);
                        $this->calculateTourAmount();    
                        $this->say('Your room(s) will be reassigned by admin/staff.<br><br> Please state your choice in the REMARKS.<br><br> Your tour price is <b>EXCLUSIVE</b> of room price. ');
                        $this->askRemarks($suitableRooms);
                    }else{
                        $this->repeat('Sorry I don\'t understand '.$newRoomAns.'.<br>Please only type (YES/NO)');
                    }
                });
            }else{
               $this->repeat('Sorry I don\'t understand '.$roomAns.'.<br>Please only type (YES/NO)');
            }
        });

    }

    public function calculateTourAmount(){
        $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();
 
    $totalTourAmount = $tour->tourPrice * ($this->bookingData['noOfAdult'] + $this->bookingData['noOfChild'] );

    $deposit = 0.3 * $totalTourAmount;

    $this->bookingData['bookingAmount'] = $totalTourAmount;
    $this->bookingData['bookingDeposit'] = $deposit;
    }

    public function calculateTotalAmount($suitableRooms)
{
       $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();

    $totalRoomAmount = $this->calculateRoomAmount($suitableRooms);

 
    $totalTourAmount = $tour->tourPrice * ($this->bookingData['noOfAdult'] + $this->bookingData['noOfChild']);

    $totalAmount = $totalRoomAmount + $totalTourAmount;

    $deposit = 0.3 * $totalAmount;

   $this->bookingData['bookingAmount'] = $totalAmount;
    $this->bookingData['bookingDeposit'] = $deposit;
}

    protected function displayRoom($suitableRooms){
        $roomsAmount = $this->calculateRoomAmount($suitableRooms);
        $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

        foreach ($suitableRooms as $room) {
            $roomCounts[$room]++;
        }

        $roomDetails = "Please state in the remarks if you want to change the room.<br><br>Suggested room(s):<br><br>";

        $roomQuantities = [];
        foreach ($roomCounts as $roomType => $count) {

            if ($count > 0) {
                $roomDetails .= "{$roomType} x {$count}<br>";
                $roomQuantities[$roomType] = $count;
            }
        }
        $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();
        $totalTourAmount = $tour->tourPrice * ($this->bookingData['noOfAdult'] + $this->bookingData['noOfChild']);

        $this->say($roomDetails.'<br>The suggested room(s) amount is <br><b>RM'.$roomsAmount.'</b><br>The amount will be added into the tour.');


        return serialize($roomQuantities);
       
    }

    public function askRemarks($suitableRooms){

        $this->ask('Thanks ! <br><br>Any remarks for the booking ?<br>If YES, please write the remarks.<br> If NO just type NO</br>', function ($answer) use ($suitableRooms){
            $remarks = strtoupper($answer->getText());
             if($remarks === 'NO'){
            $this->bookingData['bookingRemarks'] = "No remarks";
            $this->displayFinalDetails($suitableRooms);
             }else{
                $this->bookingData['bookingRemarks'] = $remarks;
                $this->displayFinalDetails($suitableRooms);
             }

           
           

        });



     }

     public function displayFinalDetails($suitableRooms ){

        $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();
    
        $package = Package::where('packageID', $tour->packageID)->first();
        $flight = Flight::where('flightID', $tour->flightID)->first();

        if($this->bookingData['bookingStatus'] === 'Room Pending'){

            $message = "Below are the booking details.<br> Kindly check before proceed.<br><br>".
            '<br><b>Tour Details:</b><br>' . '<b>Package:</b> ' . $package->packageName . '<br><b>Country:</b> ' . $package->destination . '<br><b>Tour:</b> ' . $tour->tourCode . '<br><b>Tour Price:</b> RM'.$tour->tourPrice.'/pax'. '<br><b>Departure Date:</b> ' . $flight->departureDate . '<br><br>'.
            '<b>Adults:</b> '.$this->bookingData['noOfAdult'].'<br>'.
            '<b>Children:</b> '.$this->bookingData['noOfChild'].'<br>'.
            '<b>Infant:</b> '.$this->bookingData['noOfInfant'].'<br>'.
            '<br><b>Total Amount: </b>RM '.$this->bookingData['bookingAmount'].
            '<br><b>Booking Deposit:</b> RM '.$this->bookingData['bookingDeposit'].'<br><br><p style="color:red"><b>The total amount is EXCLUSIVE room(s) amount.</b></p>';
            
             $this->say($message);

        }else{
            $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

            $roomDetails = "<b>Room Details:</b><br>";
    
            foreach ($suitableRooms as $room) {
                $roomCounts[$room]++;
            }
            foreach ($roomCounts as $roomType => $count) {
    
                if ($count > 0) {
                    $roomDetails .= "{$roomType} x {$count}<br>";
                }
            }
    
          
                    
            $message = "Below are the booking details.<br> Kindly check before proceed.<br><br>".
            '<br><b>Tour Details:</b><br>' . '<b>Package:</b> ' . $package->packageName . '<br><b>Country:</b> ' . $package->destination . '<br><b>Tour:</b> ' . $tour->tourCode . '<br><b>Tour Price:</b> RM'.$tour->tourPrice.'/pax'. '<br><b>Departure Date:</b> ' . $flight->departureDate . '<br><br>'.
            '<b>Adults:</b> '.$this->bookingData['noOfAdult'].'<br>'.
            '<b>Children:</b> '.$this->bookingData['noOfChild'].'<br>'.
            '<b>Infant:</b> '.$this->bookingData['noOfInfant'].'<br><br>'.
            $roomDetails.'<br><b>Total Amount: </b>RM '.$this->bookingData['bookingAmount'].
            '<br><b>Booking Deposit:</b> RM '.$this->bookingData['bookingDeposit'].'<br><br><p style="color:red"><b>The total amount is INCLUDED room(s) amount.</b></p>';
            
             $this->say($message);
        }

        $this->askBookingConfirmation();





     }

     protected function askBookingConfirmation(){
        $this->ask('Do you want to proceed with the booking? If NO, type EXIT', function ($answer) {
            $bookingConfirmation = strtoupper($answer->getText());

        if($bookingConfirmation === 'YES'){
            $loggedInUser = auth()->user();
            $customer = Customer::where('userID', $loggedInUser->userID)->first();


            $bookingID = IdGenerator::generate(['table'=> 'bookings','field' => 'bookingID','length' => 6, 'prefix' => 'BK']);
            $currentDate = today();

             $booking = Booking::create([
                 'bookingID' => $bookingID,
                 'bookingDate' => $currentDate,
                 'noOfAdult'=> $this->bookingData['noOfAdult'],
                 'noOfChild'=> $this->bookingData['noOfChild'],
                 'noOfInfant'=>$this->bookingData['noOfInfant'],
                 'noOfRoom'=> $this->bookingData['noOfRoom'],
                 'typesOfRoom'=> $this->bookingData['typesOfRoom'],
                 'bookingAmount'=> $this->bookingData['bookingAmount'],
                 'bookingDeposit'=> $this->bookingData['bookingDeposit'],
                 'bookingStatus'=> $this->bookingData['bookingStatus'],
                 'bookingRemarks'=> $this->bookingData['bookingRemarks'],
                 'tourCode'=> $this->bookingData['tourCode'],
                 'customerID'=> $customer->customerID,
             ]);

             Mail::to(auth()->user()->email)->send(new BookingReceipt($booking));


             $this->say('Great ! Thanks for booking from us ~<br> Your booking ('.$booking->bookingID.') is pending for approval.<br><br>Type EXIT to back to menu');


        }else{
            $this->repeat('Please insert only YES or EXIT.');
        }

        });
     }




    protected function calculateRoomAmount($rooms)
    {
        $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();
        $package = Package::where('packageID', $tour->packageID)->first();

        $roomPrices = [
            'Single Room' => $package->singleRoom,
            'Double Room' => $package->doubleRoom,
            'Triple Room' => $package->tripleRoom,
        ];
    
        $totalRoomAmount = 0;
    
        foreach ($rooms as $room) {
            $totalRoomAmount += $roomPrices[$room];
        }

        return $totalRoomAmount;
    }



    protected function validateNumberOfInfants($noOfInfant, $noOfAdult)
    {

        return $noOfInfant >= 0 && $noOfInfant <= $noOfAdult;
    }

    // Room selection methods
    protected function getSuitableRooms($noOfAdult, $noOfChild, $noOfInfant)
    {
        $totalCustomers = $noOfAdult + $noOfChild;
        $suitableRooms = [];

        $tripleRoomCount = floor($totalCustomers / $this->roomConfigurations['Triple Room']['adults']);
        $remainingCustomers = $totalCustomers % $this->roomConfigurations['Triple Room']['adults'];

        $doubleRoomCount = floor($remainingCustomers / $this->roomConfigurations['Double Room']['adults']);
        $remainingCustomers %= $this->roomConfigurations['Double Room']['adults'];

        for ($i = 0; $i < $tripleRoomCount; $i++) {
            $suitableRooms[] = 'Triple Room';
        }

        for ($i = 0; $i < $doubleRoomCount; $i++) {
            $suitableRooms[] = 'Double Room';
        }

        for ($i = 0; $i < $remainingCustomers; $i++) {
            $suitableRooms[] = 'Single Room';
        }

        return $suitableRooms;
    }

    protected function alternativeRooms($noOfAdult, $noOfChild, $noOfInfant)
    {
        $totalCustomers = $noOfAdult + $noOfChild;

        $suitableRooms = [];
    
        $doubleRoomCount = floor($totalCustomers / $this->roomConfigurations['Double Room']['adults']);
        $remainingCustomers = $totalCustomers % $this->roomConfigurations['Double Room']['adults'];
    
        $tripleRoomCount = floor($remainingCustomers / $this->roomConfigurations['Triple Room']['adults']);
        $remainingCustomers %= $this->roomConfigurations['Triple Room']['adults'];
    
        for ($i = 0; $i < $doubleRoomCount; $i++) {
            $suitableRooms[] = 'Double Room';
        }
    
        for ($i = 0; $i < $tripleRoomCount; $i++) {
            $suitableRooms[] = 'Triple Room';
        }
    
        for ($i = 0; $i < $remainingCustomers; $i++) {
            $suitableRooms[] = 'Single Room';
        }
    
        return $suitableRooms;
    }

}
