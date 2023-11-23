<?php


namespace App\Conversations;

use App\Http\Controllers\BotManController;
use App\Models\Booking;
use App\Models\Flight;
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
        $this->ask('Thanks, which tour you want to book ? (Please insert the tour code.)', function ($answer) {
            $this->bookingData['tourCode'] = strtoupper($answer->getText());
            // Retrieve tour details based on the provided tour code (implement your logic here)
            $tour = Tour::where('tourCode', $this->bookingData['tourCode'])->first();



            if ($tour) {
                $package = Package::where('packageID', $tour->packageID)->first();
                $flight = Flight::where('flightID', $tour->flightID)->first();
                $this->say('Great !<br>Please check the tour details:<br><br>' . 'Package: ' . $package->packageName . '<br>Tour: ' . $tour->tourCode . '<br>Tour Price: RM'.$tour->tourPrice.'/pax'. '<br>Departure Date: ' . $flight->departureDate . '<br><br>Insert NO if you want to reselect.'); // Display tour details
                $this->askNumberOfPeople();
            } else {
                $this->repeat('Tour is not available !<br>Please check the tour code from the DEPARTURE DATE tab in the package.');
            }
        });
    }

    public function askNumberOfPeople()
    {
        $this->ask('How many adults will be joining?', function ($answer) {
            $noOfAdult = strtoupper($answer->getText());

       


            if ($this->validateNumberOfAdults($noOfAdult)) {
                $this->bookingData['noOfAdult'] = $noOfAdult;
                $this->ask('How many children will be joining?', function ($answer) {
                    $this->bookingData['noOfChild'] = (int) $answer->getText();

                    if ($this->validateNumberOfChildren($this->bookingData['noOfChild'], $this->bookingData['noOfAdult'])) {
                        $this->ask('How many infants will be joining?', function ($answer) {
                            $this->bookingData['noOfInfant'] = (int) $answer->getText();

                            if ($this->validateNumberOfInfants($this->bookingData['noOfInfant'], $this->bookingData['noOfAdult'])) {
                                $this->askRoomSelection();

                            } else {
                                $this->say('Invalid number of infants. Please try again.');
                                $this->askNumberOfPeople();
                            }
                        });
                    } else {
                        $this->say('Invalid number of children. Please try again.');
                        $this->askNumberOfPeople();
                    }
                });
            } else {
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
 
    $totalTourAmount = $tour->tourPrice * ($this->bookingData['noOfAdult'] + $this->bookingData['noOfChild']);

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

             $this->say('Great ! Thanks for booking from us ~<br> Your booking ('.$booking->bookingID.') is pending for approval.<br><br>Type EXIT to back to menu');


        }else{
            $this->repeat('Please insert only YES or EXIT.');
        }

        });
     }

    // Validation methods

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
    protected function validateNumberOfAdults($noOfAdult)
    {
             // if($noOfAdult === 'NO') {
            //     $this->askTourCode();
            // }elseif($noOfAdult <= 0){
            //     $this->repeat('Must have atleast 1 adult to join the tour!');
            // }elseif(!is_numeric($noOfAdult)) {
            //     $this->repeat('Please insert the number of adults or NO to reselect the tour.');
            // }
        return $noOfAdult > 0;
    }

    protected function validateNumberOfChildren($noOfChild, $noOfAdult)
    {
        // Implement your validation logic for the number of children
        // For example, ensure there is at least one adult for children
        return $noOfChild >= 0 && $noOfChild <= $noOfAdult;
    }

    protected function validateNumberOfInfants($noOfInfant, $noOfAdult)
    {
        // Implement your validation logic for the number of infants
        // For example, ensure there is at least one adult for infants
        return $noOfInfant >= 0 && $noOfInfant <= $noOfAdult;
    }

    // Room selection methods
    protected function getSuitableRooms($noOfAdult, $noOfChild, $noOfInfant)
    {
        $totalCustomers = $noOfAdult + $noOfChild;
        $suitableRooms = [];

        // Try to fit triple rooms first
        $tripleRoomCount = floor($totalCustomers / $this->roomConfigurations['Triple Room']['adults']);
        $remainingCustomers = $totalCustomers % $this->roomConfigurations['Triple Room']['adults'];

        // Try to fit double rooms with the remaining customers
        $doubleRoomCount = floor($remainingCustomers / $this->roomConfigurations['Double Room']['adults']);
        $remainingCustomers %= $this->roomConfigurations['Double Room']['adults'];

        // Add triple rooms to the list
        for ($i = 0; $i < $tripleRoomCount; $i++) {
            $suitableRooms[] = 'Triple Room';
        }

        // Add double rooms to the list
        for ($i = 0; $i < $doubleRoomCount; $i++) {
            $suitableRooms[] = 'Double Room';
        }

        // Add single rooms to the list (updated logic)
        for ($i = 0; $i < $remainingCustomers; $i++) {
            $suitableRooms[] = 'Single Room';
        }

        return $suitableRooms;
    }

    protected function alternativeRooms($noOfAdult, $noOfChild, $noOfInfant)
    {
        $totalCustomers = $noOfAdult + $noOfChild;

        $suitableRooms = [];
    
        // Try to fit double rooms first
        $doubleRoomCount = floor($totalCustomers / $this->roomConfigurations['Double Room']['adults']);
        $remainingCustomers = $totalCustomers % $this->roomConfigurations['Double Room']['adults'];
    
        // Try to fit triple rooms with the remaining customers
        $tripleRoomCount = floor($remainingCustomers / $this->roomConfigurations['Triple Room']['adults']);
        $remainingCustomers %= $this->roomConfigurations['Triple Room']['adults'];
    
        // Add double rooms to the list
        for ($i = 0; $i < $doubleRoomCount; $i++) {
            $suitableRooms[] = 'Double Room';
        }
    
        // Add triple rooms to the list
        for ($i = 0; $i < $tripleRoomCount; $i++) {
            $suitableRooms[] = 'Triple Room';
        }
    
        // Add single rooms to the list (updated logic)
        for ($i = 0; $i < $remainingCustomers; $i++) {
            $suitableRooms[] = 'Single Room';
        }
    
        return $suitableRooms;
    }

}
