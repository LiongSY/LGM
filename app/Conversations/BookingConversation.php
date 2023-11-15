<?php

// app/Conversations/BookTourConversation.php

namespace App\Conversations;
use App\Models\Flight;
use App\Models\Itinerary;
use App\Models\Package;
use App\Models\Tour;
use BotMan\BotMan\Messages\Conversations\Conversation;

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
            $tourCode = strtoupper($answer->getText());
            // Retrieve tour details based on the provided tour code (implement your logic here)
            $tour = Tour::where('tourCode', $tourCode)->first();
            


            if ($tour){
                $package = Package::where('packageID', $tour->packageID)->first();
                $flight = Flight::where('flightID', $tour->flightID)->first();
                $this->say('Great !<br>Please check the tour details:<br><br>' .'Package: '. $package->packageName.'<br>Tour: '.$tour->tourCode.'<br>Departure Date: '.$flight->departureDate.'<br><br>Insert NO if you want to reselect.'); // Display tour details
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
            
            // if($noOfAdult === 'NO') {
            //     $this->askTourCode();
            // }elseif($noOfAdult <= 0){
            //     $this->repeat('Must have atleast 1 adult to join the tour!');
            // }elseif(!is_numeric($noOfAdult)) {
            //     $this->repeat('Please insert the number of adults or NO to reselect the tour.');
            // }


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

        $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

foreach ($suitableRooms as $room) {
    $roomCounts[$room]++;
}

$roomDetails = "Please state in remarks if you want to change the room.<br><br>Suggested room(s):<br><br>";
foreach ($roomCounts as $roomType => $count) {
    
    if ($count > 0) {
        $roomDetails .= "{$roomType} x {$count}<br>";
    }
}

$this->say($roomDetails);
    }

    // Validation methods
    protected function validateNumberOfAdults($noOfAdult)
    {
        // Implement your validation logic for the number of adults
        // For example, check if the number is positive and within a certain range
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

}
