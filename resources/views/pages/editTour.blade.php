@extends('layouts.app', ['class' => '', 'elementActive' => 'package'])

@section('content')

<div class="content">
    <div class="row">
    <div class="col-md-8"> 
        <div class="card">

        <div class="card-body">
        <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>

            <!-- Form for Packages Management -->
            <form onsubmit="return validateForm()" action="{{ route('package.updateTour', $tour->tourCode) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    <a href="{{ URL::previous() }}" class="btn btn-secondary" style="float:right; top:0px">Back</a>

                    <div class="card-header" style="padding-left:0px"> <b>UPDATE {{ $tour->tourCode }}<b></div>
                    <hr>
                    <div class="tourRow">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="tourLanguages">Tour Languages:</label>
                                <input type="text" class="form-control" id="tourLanguages" value="{{ $tour->tourLanguages }}" name="tourLanguages" required>
                            </div>
                            <div class="col-md-4">
                                <label for="tourPrice">Tour Price:</label>
                                <input type="number" class="form-control" id="tourPrice" value="{{ $tour->tourPrice }}" name="tourPrice" required>
                            </div>
                            <div class="col-md-4">
                                <label for="noOfSeats">Number of Seats:</label>
                                <input type="number" class="form-control" id="noOfSeats" value="{{ $tour->noOfSeats }}" name="noOfSeats" required>
                            </div>
                        </div>

                        <div class="card-header" style="padding-left:0px"> Flight Details
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sector">Sector:</label>
                                <input type="text" class="form-control" id="sector" value="{{ $flight->sector }}" name="sector" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="airlines">Airlines:</label>
                                <input type="text" class="form-control" id="airlines" value="{{ $flight->airlines }}" name="airlines" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="flightNumber">Flight Number:</label>
                                <input type="text" class="form-control" id="flightNumber" value="{{ $flight->flightNumber }}" name="flightNumber" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departureDate">Departure Date:</label>
                                <input type="date" class="form-control" id="departureDate" value="{{ $flight->departureDate }}" name="departureDate" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="returnDate">Arrival Date:</label>
                                <input type="date" class="form-control" id="returnDate" value="{{ $flight->arrivalDate }}" name="arrivalDate" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departureTime">Departure Time:</label>
                                <input type="time" class="form-control" id="departureTime" value="{{ $flight->departureTime }}" name="departureTime" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="returnTime">Arrival Time:</label>
                                <input type="time" class="form-control" id="arrivalTime" value="{{ $flight->arrivalTime }}" name="arrivalTime" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="sector">Return Sector:</label>
                                <input type="text" class="form-control" id="reuturnSector" value="{{ $flight->returnSector }}" name="returnSector" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="airlines">Return Airlines:</label>
                                <input type="text" class="form-control" id="returnAirlines" value="{{ $flight->returnAirlines }}" name="returnAirlines" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="flightNumber">Return Flight Number:</label>
                                <input type="text" class="form-control" id="returnFlightNumber" value="{{ $flight->returnFlightNumber }}" name="returnFlightNumber" required>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departureDate">Return Departure Date:</label>
                                <input type="date" class="form-control" id="departureDate" value="{{ $flight->returnDepartureDate }}" name="returnDepartureDate" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="returnDate"> Return Arrival Date:</label>
                                <input type="date" class="form-control" id="returnDate" value="{{ $flight->returnArrivalDate }}" name="returnArrivalDate" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="departureTime">Return Departure Time:</label>
                                <input type="time" class="form-control" id="returndDepartureTime" value="{{ $flight->returnDepartureTime }}" name="returnDepartureTime" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="returnTime">Return Arrival Time:</label>
                                <input type="time" class="form-control" id="returnArrivalTime" value="{{ $flight->returnArrivalTime }}" name="returnArrivalTime" required>
                            </div>
                        </div>

                    </div>


                        <button type="submit" class="btn btn-primary"style="float:left">Update Tour</button>

            </form>

        </div>
        </div>
    </div>
</div>
</div>



<script>
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