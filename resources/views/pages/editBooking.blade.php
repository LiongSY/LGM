@extends('layouts.app', ['class' => '', 'elementActive' => 'map'])

@section('content')

<div class="content"> <div id="step1"> <div class="row">
    <div class="col-md-8"> <div class="card">

        <div class="card-body">
        <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>

            <!-- Form for Packages Management -->
            <form onsubmit="return validateForm()" action="{{ route('booking.update', $booking->bookingID) }}" method="POST">
                @csrf
                @method('PUT')
                <div>    <a href="{{ URL::previous() }}" class="btn btn-secondary" style="float:right; top:0px">Back</a>

                    <div class="card-header" style="padding-left:0px"> <b>Update Booking<b>
                        
                    </div>
                    <hr>
                    <div class="form-row">                    
                        <div class="form-group col-md-6">
                            <label for="destination">Booking Date:</label>
                            <input type="text" class="form-control" id="bookingID" value="{{ $booking->bookingDate }}" name="bookingID" readonly>
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label for="bookingID">Booking ID:</label>
                        <input type="text" class="form-control" id="bookingID" value="{{ $booking->bookingID }}" name="bookingID" readonly>
                    </div>
                    </div>
                    @php
    $noOfRooms = unserialize($booking->noOfRoom);
    $suitableRooms = unserialize($booking->typesOfRoom);
    $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

    $roomQuantities = [];
    $roomTypes = array_unique($suitableRooms);

    foreach ($suitableRooms as $room) {
        $roomCounts[$room]++;
    }
@endphp

                    <label for="noOfRoom">Number of Rooms:</label>

<div id="roomSelection">
    @foreach (roomCounts as $roomType)
        @php
            $roomData = unserialize($booking->noOfRoom);
            $roomQuantity = isset($roomData[$roomType]) ? $roomData[$roomType] : 0;
        @endphp
        <div class="room-type">
            <label for="{{ $roomType }}Room">{{ ucfirst($roomType) }} Room:</label>
            <input type="number" id="{{ $roomType }}Room" name="noOfRoom[{{ $roomType }}]" value="{{ $roomQuantity }}" readonly>
            <button type="button" onclick="updateQuantity('{{ $roomType }}', 1)">+</button>
            <button type="button" onclick="updateQuantity('{{ $roomType }}', -1)">-</button>
        </div>
    @endforeach
</div>

                    <div class="form-group">
                        <label for="remarks">Remarks for the booking:</label>
                        <textarea class="form-control long-textarea" id="packageRemarks" name="packageRemarks" readonly>{{$booking->bookingRemarks}}</textarea>
                    </div>

                    
                        <button type="submit" class="btn btn-primary">Update </button>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



<script>
        function updateQuantity(roomType, change) {
        const inputElement = document.getElementById(roomType + 'Room');
        const currentValue = parseInt(inputElement.value, 10) || 0;
        const newValue = currentValue + change;

        if (newValue >= 0) {
            inputElement.value = newValue;
        }
    }

function validateForm() {
    document.getElementById("errorMessages").style.display = "none";
    document.getElementById("errorMessages").innerHTML = "";

        var packageName = document.getElementById("packageName").value;
        var packageHighlight = document.getElementById("packageHighlight").value;
        var destination = document.getElementById("destination").value;
        var packageRemarks = document.getElementById("packageRemarks").value;
        var departureDates = document.getElementsByName("departureDate[]");
        var returnDates = document.getElementsByName("returnDate[]");
        var hotelNames = document.getElementsByName("hotelName[]");
        var tourLanguages = document.getElementsByName("tourLanguages[]");
        var sector = document.getElementsByName("sector[]");
        
        var hasError = false;
        var malaysiaTimezoneOffset = 8 * 60; // Malaysia is UTC+8
        var malaysiaCurrentTime = new Date(new Date() - malaysiaTimezoneOffset * 60 * 1000);

        for (var i = 0; i < departureDates.length; i++) {
        var departureDate = new Date(departureDates[i].value);
        var returnDate = new Date(returnDates[i].value);

        if (departureDate < malaysiaCurrentTime) {
        var errorMessage = "Tour " + (i + 1) + ": Departure Date cannot be before the current date.<br>";
        document.getElementById("errorMessages").innerHTML += errorMessage;
        hasError = true;
    }

        if (departureDate >= returnDate) {
            var errorMessage = "Tour " + (i + 1) + ": Arrival Date must be after Departure Date.<br>";
            document.getElementById("errorMessages").innerHTML += errorMessage;
            hasError = true;
        }
       }

       for (var i = 0; i < hotelNames.length; i++) {
        if (hotelNames[i].value.length > 60) {
            var errorMessage = "Day " + (i + 1) + ": Hotel's name cannot more than 60 characters.<br>";
            document.getElementById("errorMessages").innerHTML += errorMessage;
            hasError = true;
        }
       }

       for (var i = 0; i < tourLanguages.length; i++) {
        if (tourLanguages[i].value.length > 60) {
            var errorMessage = "Tour " + (i + 1) + ": Languages must not exceed 30 characters.<br>";
            document.getElementById("errorMessages").innerHTML += errorMessage;
            hasError = true;
        }
       }

       for (var i = 0; i < sector.length; i++) {
        if (sector[i].value.length > 60) {
            var errorMessage = "Tour " + (i + 1) + ": Sector must not exceed 50 characters.<br>";
            document.getElementById("errorMessages").innerHTML += errorMessage;
            hasError = true;
        }
       }


        // if (destination.length > 40) {
        //     alert("Destination must not exceed 40 characters.");
        //     return false;
        // }

        // if (sector.length > 50) {
        //     alert("Sector must not exceed 50 characters.");
        //     return false;
        // }

        // // Validate packageName
        // if (packageName === "") {
        //     displayError("packageName", errors.packageName);
        //     return false;
        // }

        // // Validate packageHighlight
        // if (packageHighlight === "") {
        //     displayError("packageHighlight", errors.packageHighlight);
        //     return false;
        // }

        // // Validate destination
        // if (destination === "") {
        //     displayError("destination", errors.destination);
        //     return false;
        // }

        // if (packageRemarks === "") {
        //     displayError("packageRemarks", errors.packageRemarks);
        //     return false;
        // }

        if (hasError) {
        // Show error messages at the top of the form
        document.getElementById("errorMessages").style.display = "block";
        return false;
            }

        // If all validations pass, return true to allow the form submission
        return true;
    }

 

</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

@endsection