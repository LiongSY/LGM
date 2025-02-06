@extends('layouts.app', ['class' => '', 'elementActive' => 'package'])

@section('content')

<div class="content">
    <div id="step1">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>

                        <!-- Form for Packages Management -->
                        <form onsubmit="return validateForm()" action="{{ route('pages.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div>
                                <a href="{{ URL::previous() }}" class="btn btn-secondary"
                                    style="float:right; top:0px">Back</a>

                                <div class="card-header" style="padding-left:0px"> <b>Package Management<b>

                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="packageName">Package Name:</label>
                                        <input type="text" class="form-control" id="packageName" placeholder="Package Name" name="packageName"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="destination">Country:</label>
                                        <input type="text" class="form-control" id="destination" name="destination" placeholder="Country Name"
                                            required>
                                    </div>

                                    
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                        <label for="packageImage">Package Image:</label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control-file" id="packageImage"
                                                name="packageImage" accept="image/*" onchange="displayImageName()" required>

                                            <label class="custom-file-label" for="packageImage">Choose Image</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="packageHighlight">Highlight of the Package:</label>
                                    <textarea class="form-control long-textarea" id="packageHighlight"
                                        name="packageHighlight" placeholder="Write the highlight here..." required></textarea>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="singleRoom">Single Room Price:</label>
                                        <input type="number" class="form-control" id="singleRoom" name="singleRoom"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="doubleRoom">Double Room Price:</label>
                                        <input type="number" class="form-control" id="doubleRoom" name="doubleRoom"
                                            required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tripleRoom">Triple Room Price:</label>
                                        <input type="number" class="form-control" id="tripleRoom" name="tripleRoom"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="remarks">Remarks for the Package:</label>
                                    <textarea class="form-control long-textarea" id="packageRemarks"
                                        name="packageRemarks" placeholder="Write the package remarks here..." required></textarea>
                                </div>

                                <br>

                                <div class="card-header" style="padding-left:0px"> Tour 1
                                </div>
                                <hr>
                                <div class="tourRow">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label for="tourLanguages">Tour Languages:</label>
                                            <input type="text" class="form-control" id="tourLanguages"
                                                name="tourLanguages[]" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tourPrice">Tour Price:</label>
                                            <input type="number" class="form-control" id="tourPrice" name="tourPrice[]"
                                                required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="noOfSeats">Number of Seats:</label>
                                            <input type="number" class="form-control" id="noOfSeats" name="noOfSeats[]"
                                                required>
                                        </div>
                                    </div>

                                    <div class="card-header" style="padding-left:0px"> Flight Details
                                    </div>
                                    <hr>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sector">Sector:</label>
                                            <input type="text" class="form-control" placeholder="From / To" id="sector" name="sector[]"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="airlines">Airlines:</label>
                                            <input type="text" class="form-control" id="airlines" name="airlines[]"
                                                required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="flightNumber">Flight Number:</label>
                                            <input type="text" class="form-control" id="flightNumber" 
                                                name="flightNumber[]" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="departureDate">Departure Date:</label>
                                            <input type="date" class="form-control" id="departureDate"
                                                name="departureDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnDate">Arrival Date:</label>
                                            <input type="date" class="form-control" id="returnDate" name="arrivalDate[]"
                                                required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="departureTime">Departure Time:</label>
                                            <input type="time" class="form-control" id="departureTime"
                                                name="departureTime[]" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnTime">Arrival Time:</label>
                                            <input type="time" class="form-control" id="arrivalTime"
                                                name="arrivalTime[]" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sector">Return Sector:</label>
                                            <input type="text" class="form-control" placeholder="Return From / Back To" id="reuturnSector"
                                                name="returnSector[]" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="airlines">Return Airlines:</label>
                                            <input type="text" class="form-control" id="returnAirlines"
                                                name="returnAirlines[]" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="flightNumber">Return Flight Number:</label>
                                            <input type="text" class="form-control" id="returnFlightNumber"
                                                name="returnFlightNumber[]" required>
                                        </div>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="departureDate">Return Departure Date:</label>
                                            <input type="date" class="form-control" id="departureDate"
                                                name="returnDepartureDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnDate"> Return Arrival Date:</label>
                                            <input type="date" class="form-control" id="returnDate"
                                                name="returnArrivalDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="departureTime">Return Departure Time:</label>
                                            <input type="time" class="form-control" id="returndDepartureTime"
                                                name="returnDepartureTime[]" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnTime">Return Arrival Time:</label>
                                            <input type="time" class="form-control" id="returnArrivalTime"
                                                name="returnArrivalTime[]" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-warning addTourBtn">Add Tour</button>
                            </div>

                            <br>
                            <div class="card-header" style="padding-left:0px"> <b>Itinerary<b>
                            </div>
                            <hr>
                            <div class="firstRow">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="noOfDays">Number of Days:</label>
                                        <input type="number" class="form-control" id="noOfDays" name="noOfDays[]"
                                            required readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="remarks">Remarks:</label>
                                        <input type="text" class="form-control" id="remarks" name="remarks[]" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="hotelName">Hotel Name:</label>
                                        <input type="text" class="form-control" id="hotelName" name="hotelName[]"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="meals">Meals:</label>
                                        <br>
                                        <div class="checkbox-group">
                                            <input class="custom-checkbox" type="checkbox" name="meals[0][]" value="B">
                                            <label class="custom-label">Breakfast</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input class="custom-checkbox" type="checkbox" name="meals[0][]" value="L">
                                            <label class="custom-label">Lunch</label>
                                        </div>
                                        <div class="checkbox-group">
                                            <input class="custom-checkbox" type="checkbox" name="meals[0][]" value="D">
                                            <label class="custom-label">Dinner</label>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="information">Information:</label>
                                    <textarea class="form-control long-textarea" id="information" placeholder="Write the information here..." name="information[]"
                                        required></textarea>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button class="btn btn-warning addField">Add More</button>
                            </div>
                    </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
</div>


<script>

    function displayImageName() {
        var input = document.getElementById('packageImage');
var fileName = input.files[0].name;
var label = document.querySelector('.custom-file-label');
label.textContent = fileName;
} 
    function validateForm() {
        document.getElementById("errorMessages").style.display = "none";
        document.getElementById("errorMessages").innerHTML = "";

        var packageName = document.getElementById("packageName").value;
        // var packageHighlight = tinymce.get('packageHighlight').getContent();
        var packageName = document.getElementById("packageName").value;

        var destination = document.getElementById("destination").value;
        var packageRemarks = document.getElementById("packageRemarks").value;
        var packageImage = document.getElementById("packageImage").files[0];
        var singleRoom = document.getElementById("singleRoom").value;
        var doubleRoom = document.getElementById("doubleRoom").value;
        var tripleRoom = document.getElementById("tripleRoom").value;

        var tourLanguages = document.getElementsByName("tourLanguages[]");
        var tourPrice = document.getElementsByName("tourPrice[]");
        var noOfSeats = document.getElementsByName("noOfSeats[]");

        var sectors = document.getElementsByName("sector[]");
        var airlines = document.getElementsByName("airlines[]");
        var flightNumbers = document.getElementsByName("flightNumber[]");
        var departureDates = document.getElementsByName("departureDate[]");
        var arrivalDates = document.getElementsByName("arrivalDate[]");
        var departureTimes = document.getElementsByName("departureTime[]");
        var arrivalTimes = document.getElementsByName("arrivalTime[]");
        var returnSectors = document.getElementsByName("returnSector[]");
        var returnAirlines = document.getElementsByName("returnAirlines[]");
        var returnFlightNumbers = document.getElementsByName("returnFlightNumber[]");
        var returnDepartureDates = document.getElementsByName("returnDepartureDate[]");
        var returnArrivalDates = document.getElementsByName("returnArrivalDate[]");
        var returnDepartureTimes = document.getElementsByName("returnDepartureTime[]");
        var returnArrivalTimes = document.getElementsByName("returnArrivalTime[]");


        var noOfDays = document.getElementsByName("noOfDays[]");
        var remarks = document.getElementsByName("remarks[]");
        var hotelNames = document.getElementsByName("hotelName[]");
        var information = document.getElementsByName("information[]");

        var hasError = false;
        var malaysiaTimezoneOffset = 8 * 60; // Malaysia is UTC+8
        var malaysiaCurrentTime = new Date(new Date() - malaysiaTimezoneOffset * 60 * 1000);
        var regex = /^[a-zA-Z\s]+$/;

        if (packageName.length > 50) {
            var errorMessage = "Package Name cannot exceed 50 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
           }

        if (destination.length > 30) {
        var errorMessage = "Country Name cannot exceed 30 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
         }

         if (!regex.test(destination.trim())) {
            var errorMessage = "Country Name only can have characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
         }


        if (singleRoom <= 0 || doubleRoom <= 0 || tripleRoom <= 0) {
            var errorMessage = "Room prices cannot be 0 or below 0.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;    
            }


        for (var i = 0; i < hotelNames.length; i++) {
            if (hotelNames[i].value.length > 60) {
                var errorMessage = "Day " + (i + 1) + ": Hotel's name cannot more than 60 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < tourPrice.length; i++) {
        if (parseFloat(tourPrice[i].value) <= 0) {
            var errorMessage = "Tour " + (i + 1) + ": Tour price must be greater than 0.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;            
        }
    }

    for (var i = 0; i < noOfSeats.length; i++) {
        if (parseFloat(noOfSeats[i].value) <= 0) {
            var errorMessage = "Tour " + (i + 1) + ": No of seats must be greater than 0.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;            
        }
    }

    for (var i = 0; i < tourLanguages.length; i++) {
        if (!regex.test(tourLanguages[i].value.trim())) {
            var errorMessage = "Tour " + (i + 1) + ": Tour Languages must be alphabets.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }
    }

        for (var i = 0; i < tourLanguages.length; i++) {
            if (tourLanguages[i].value.length > 60) {
                var errorMessage = "Tour " + (i + 1) + ": Tour Languages must not exceed 30 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < sectors.length; i++) {
            if (sectors[i].value.length > 60) {
                var errorMessage = "Tour " + (i + 1) + ": Sector must not exceed 50 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }

            if (returnSectors[i].value.length > 60) {
                var errorMessage = "Tour " + (i + 1) + ": Return sector must not exceed 50 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < airlines.length; i++) {
            if (airlines[i].value.length > 60) {
                var errorMessage = "Tour " + (i + 1) + ": Airline name must not exceed 50 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < returnAirlines.length; i++) {
            if (returnAirlines[i].value.length > 60) {
                var errorMessage = "Tour " + (i + 1) + ": Return airline name must not exceed 50 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < flightNumbers.length; i++) {
            if (flightNumbers[i].value.length > 30) {
                var errorMessage = "Tour " + (i + 1) + ": Flight numbers must not exceed 30 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < returnFlightNumbers.length; i++) {
            if (returnFlightNumbers[i].value.length > 30) {
                var errorMessage = "Tour " + (i + 1) + ": Return flight numbers must not exceed 30 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }

        for (var i = 0; i < remarks.length; i++) {
            if (remarks[i].value.length > 150) {
                var errorMessage = "Day " + (i + 1) + ": remarks must not exceed 150 characters.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
            }
        }


        for (var i = 0; i < departureDates.length; i++) {

        if (new Date(departureDates[i].value + ' ' + departureTimes[i].value) >= new Date(arrivalDates[i].value + ' ' + arrivalTimes[i].value) || arrivalTimes[i].value - departureTimes[i].value >= 24 * 60 * 60 * 1000) {
        var errorMessage = "Tour " + (i + 1) + ": Departure and arrival times must be within the same date (less than 24 hours apart).<br>";
        document.getElementById("errorMessages").innerHTML += errorMessage;
        hasError = true;
        }

        if (new Date(returnDepartureDates[i].value + ' ' + returnDepartureTimes[i].value) >= new Date(returnArrivalDates[i].value + ' ' + returnArrivalTimes[i].value) || returnArrivalTimes[i].value - returnDepartureTimes[i].value >= 24 * 60 * 60 * 1000) {
            var errorMessage = "Tour " + (i + 1) + ": Return departure and return arrival times must be within the same date (less than 24 hours apart).<br>";
            document.getElementById("errorMessages").innerHTML += errorMessage;
            hasError = true;
        }


        if (arrivalDates[i].value < departureDates[i].value ) {
            var errorMessage = "Tour " + (i + 1) + ": Arrival date must be after the departure date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }

        if(returnDepartureDates[i].value < departureDates[i].value){
            var errorMessage = "Tour " + (i + 1) + ": Return departure date must be after the departure date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }

        if(returnDepartureDates[i].value < arrivalDates[i].value){
            var errorMessage = "Tour " + (i + 1) + ": Return departure date must be after the arrival date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }

        if(returnArrivalDates[i].value < departureDates[i].value){
            var errorMessage = "Tour " + (i + 1) + ": Return arrival date must be after the departure date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }

        if(returnArrivalDates[i].value < arrivalDates[i].value){
            var errorMessage = "Tour " + (i + 1) + ": Return arrival date must be after the arrival date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }

        if(returnArrivalDates[i].value < returnDepartureDates[i].value  ){
            var errorMessage = "Tour " + (i + 1) + ": Return arrival date must be after the return departure date.<br>";
                document.getElementById("errorMessages").innerHTML += errorMessage;
                hasError = true;
        }


    }
        if (hasError) {
            // Show error messages at the top of the form
            document.getElementById("errorMessages").style.display = "block";
            return false;
        }

        // If all validations pass, return true to allow the form submission
        return true;
    }


    $(document).ready(function () {
        //     // Initialize the number of days counter
        var numOfDays = 1;
        var counter = 0;

        $('#noOfDays').val(1);

        $('.addField').click(function () {
            counter++;

            // Increment the number of days for the new field
            numOfDays++;

            // Create a new row with the updated number of days
            var newRow = `
            <div class="firstRow">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="noOfDays">Number of Days:</label>
                        <input type="number" class="form-control" id="noOfDays" name="noOfDays[]" value="${numOfDays}" required readonly>
                    </div>
                    <div class="form-group col-md-3">
                                <label for="remarks">Remarks:</label>
                                <input type="text" class="form-control" id="remarks" name="remarks[]" required>
                            </div>
                    <div class="form-group col-md-4">
                        <label for="hotelName">Hotel Name:</label>
                        <input type="text" class="form-control" id="hotelName" name="hotelName[]" required>
                    </div>
                    </div>
                    <div class="form-row">

                    <div class="form-group col-md-6">
                    <label for="meals">Meals:</label>
                    <br>
                    <div class="checkbox-group">
                        <input class="custom-checkbox" type="checkbox" name="meals[${counter}][]" value="B">
                        <label class="custom-label">Breakfast</label>
                    </div>
                    <div class="checkbox-group">
                        <input class="custom-checkbox" type="checkbox" name="meals[${counter}][]" value="L">
                        <label class="custom-label">Lunch</label>
                    </div>
                    <div class="checkbox-group">
                        <input class="custom-checkbox" type="checkbox" name="meals[${counter}][]" value="D">
                        <label class="custom-label">Dinner</label>
                    </div>
                    </div>

                </div>
                <div class="form-group">
                    <label for="information">Information:</label>
                    <textarea class="form-control long-textarea" id="information" name="information[]" placeholder="Write the information here..." required></textarea>
                </div>
                <button type="button" class="btn btn-danger deleteRow">Delete</button>
            </div>`;
            $('.firstRow:last .deleteRow').remove();
            $('.firstRow:last').after(newRow);
            // handleFileInputChange(counter);

        });

        // Handle delete row functionality
        $(document).on('click', '.deleteRow', function () {
            // Remove the entire row when delete button is clicked
            $(this).closest('.firstRow').remove();
            // Decrement the number of days counter when a row is deleted
            numOfDays--;
            counter--;

            if (numOfDays > 1) {
                $('.firstRow:last').append('<button type="button" class="btn btn-danger deleteRow">Delete</button>');
            }

        });

    });





    $(document).ready(function () {
        //     // Initialize the number of days counter
        var numOfTour = 1;

        $('.addTourBtn').click(function () {

            // Increment the number of days for the new field
            numOfTour++;

            // Create a new row with the updated number of days
            var newTourRow = `
            <div class="tourRow">
            <br>
        <div class="card-header" style="padding-left:0px"> Tour ${numOfTour}
                    </div>
                    <hr>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="tourLanguages">Tour Languages:</label>
                                <input type="text" class="form-control" id="tourLanguages" name="tourLanguages[]">
                            </div>
                            <div class="col-md-4">
                                <label for="tourPrice">Tour Price:</label>
                                <input type="number" class="form-control" id="tourPrice" name="tourPrice[]">
                            </div>
                            <div class="col-md-4">
                                <label for="noOfSeats">Number of Seats:</label>
                                <input type="number" class="form-control" id="noOfSeats" name="noOfSeats[]">
                            </div>
                        </div>
                    
                    <div class="card-header" style="padding-left:0px"> Flight Details
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="sector">Sector:</label>
                            <input type="text" class="form-control" id="sector" name="sector[]" placeholder="From / To" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="airlines">Airlines:</label>
                            <input type="text" class="form-control" id="airlines" name="airlines[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="flightNumber">Flight Number:</label>
                            <input type="text" class="form-control" id="flightNumber" name="flightNumber[]" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="departureDate">Departure Date:</label>
                            <input type="date" class="form-control" id="departureDate" name="departureDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnDate">Arrival Date:</label>
                            <input type="date" class="form-control" id="arrivalDate" name="arrivalDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="departureTime">Departure Time:</label>
                            <input type="time" class="form-control" id="departureTime" name="departureTime[]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnTime">Arrival Time:</label>
                            <input type="time" class="form-control" id="arrivalTime" name="arrivalTime[]" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="sector">Return Sector:</label>
                            <input type="text" class="form-control" id="reuturnSector" name="returnSector[]" placeholder="Return From / Back To" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="airlines">Return Airlines:</label>
                            <input type="text" class="form-control" id="returnAirlines" name="returnAirlines[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="flightNumber">Return Flight Number:</label>
                            <input type="text" class="form-control" id="returnFlightNumber" name="returnFlightNumber[]" required>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="departureDate">Return Departure Date:</label>
                            <input type="date" class="form-control" id="departureDate" name="returnDepartureDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnDate"> Return Arrival Date:</label>
                            <input type="date" class="form-control" id="returnDate" name="returnArrivalDate[]" required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="departureTime">Return Departure Time:</label>
                            <input type="time" class="form-control" id="returndDepartureTime" name="returnDepartureTime[]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnTime">Return Arrival Time:</label>
                            <input type="time" class="form-control" id="returnArrivalTime" name="returnArrivalTime[]" required>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-danger deleteTourRow">Delete</button>

            </div>`;
            $('.tourRow:last .deleteTourRow').remove();
            $('.tourRow:last').after(newTourRow);

        });

        // Handle delete row functionality
        $(document).on('click', '.deleteTourRow', function () {
            // Remove the entire row when delete button is clicked
            $(this).closest('.tourRow').remove();
            // Decrement the number of days counter when a row is deleted
            numOfTour--;

            if (numOfTour > 1) {
                $('.tourRow:last').append('<button type="button" class="btn btn-danger deleteTourRow">Delete</button>');
            }

        });

    });





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