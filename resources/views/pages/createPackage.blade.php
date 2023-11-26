@extends('layouts.app', ['class' => '', 'elementActive' => 'map'])

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
                                        <input type="text" class="form-control" id="packageName" name="packageName"
                                            required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="destination">Country:</label>
                                        <input type="text" class="form-control" id="destination" name="destination"
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
                                        name="packageHighlight" required></textarea>
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
                                        name="packageRemarks" required></textarea>
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
                                            <input type="text" class="form-control" id="sector" name="sector[]"
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
                                                name="departureDate[]" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnDate">Arrival Date:</label>
                                            <input type="date" class="form-control" id="returnDate" name="arrivalDate[]"
                                                required>
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
                                            <input type="text" class="form-control" id="reuturnSector"
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
                                                name="returnDepartureDate[]" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="returnDate"> Return Arrival Date:</label>
                                            <input type="date" class="form-control" id="returnDate"
                                                name="returnArrivalDate[]" required>
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
                                    <!-- <div class="form-group col-md-6">
                            <label for="images">Images:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="images_0" name="images[0][]" multiple>
                                <label class="custom-file-label" for="images">Choose file</label>
                            </div>
                              </div>
                             <div class="form-group">
                             <div id="uploadedFiles_0" class="border-success p-2"></div>
                            </div> -->

                                </div>
                                <div class="form-group">
                                    <label for="information">Information:</label>
                                    <textarea class="form-control long-textarea" id="information" name="information[]"
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
                    <textarea class="form-control long-textarea" id="information" name="information[]" required></textarea>
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
                            <input type="text" class="form-control" id="sector" name="sector[]" required>
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
                            <input type="date" class="form-control" id="departureDate" name="departureDate[]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnDate">Arrival Date:</label>
                            <input type="date" class="form-control" id="arrivalDate" name="arrivalDate[]" required>
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
                            <input type="text" class="form-control" id="reuturnSector" name="returnSector[]" required>
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
                            <input type="date" class="form-control" id="departureDate" name="returnDepartureDate[]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="returnDate"> Return Arrival Date:</label>
                            <input type="date" class="form-control" id="returnDate" name="returnArrivalDate[]" required>
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