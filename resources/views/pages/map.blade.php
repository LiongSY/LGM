@extends('layouts.app', ['class' => '', 'elementActive' => 'map'])

@section('content')
<div class="content"> 

<div id="step1">
    <div class="row"> 
        <div class="col-md-8"> 
            <div class="card"> <div class="card-header"> Itineray Management</div>

    <div class="card-body">
        <!-- Form for Packages Management -->
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="firstRow">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="noOfDays">Number of Days:</label>
                            <input type="number" class="form-control" id="noOfDays" name="noOfDays[]" required readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hotelName">Hotel Name:</label>
                            <input type="text" class="form-control" id="hotelName" name="hotelName[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="meals">Meals:</label>
                            <br>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="breakfastCheckbox" name="meals[]"
                                    value="B">
                                <label class="custom-label" for="breakfastCheckbox">Breakfast</label>
                            </div>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="lunchCheckbox" name="meals[]"
                                    value="L">
                                <label class="custom-label" for="lunchCheckbox">Lunch</label>
                            </div>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="dinnerCheckbox" name="meals[]"
                                    value="D">
                                <label class="custom-label" for="dinnerCheckbox">Dinner</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="information">Information:</label>
                        <textarea class="form-control long-textarea" id="information" name="information[]"
                            required></textarea>
                    </div>
                </div>
                <div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    <button class="btn btn-warning addField">Add More</button>
                </div>
            </div>
         </form>

    </div>
    <button class="btn btn-success nextButton" onclick="topFunction()">Next</button>

</div>

</div>
</div>
</div>


<div id="step2" style="display: none;">
    <div class="row"> 
        <div class="col-md-8"> 
            <div class="card"> <div class="card-header"> 2</div>

    <div class="card-body">
        <!-- Form for Packages Management -->
        <!-- <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <div class="firstRow">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="noOfDays">Number of Days:</label>
                            <input type="number" class="form-control" id="noOfDays" name="noOfDays[]" required readonly>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="hotelName">Hotel Name:</label>
                            <input type="text" class="form-control" id="hotelName" name="hotelName[]" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="meals">Meals:</label>
                            <br>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="breakfastCheckbox" name="meals[]"
                                    value="B">
                                <label class="custom-label" for="breakfastCheckbox">Breakfast</label>
                            </div>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="lunchCheckbox" name="meals[]"
                                    value="L">
                                <label class="custom-label" for="lunchCheckbox">Lunch</label>
                            </div>
                            <div class="checkbox-group">
                                <input class="custom-checkbox" type="checkbox" id="dinnerCheckbox" name="meals[]"
                                    value="D">
                                <label class="custom-label" for="dinnerCheckbox">Dinner</label>
                            </div>
                        </div>
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
         </form> -->

    </div>
    <button class="btn btn-primary previousButton">Back</button>
    <button class="btn btn-success nextButton">Next</button>
</div>

</div>
</div>
</div>
</div>


<script>
    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
    $(document).ready(function () {
        // Initialize the number of days counter
        var numOfDays = 1;
        $('#noOfDays').val(1);


        $('.addField').click(function () {
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
                    <div class="form-group col-md-4">
                        <label for="hotelName">Hotel Name:</label>
                        <input type="text" class="form-control" id="hotelName" name="hotelName[]" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="meals">Meals:</label>
                        <br>
                        <div class="checkbox-group">
                            <input class="custom-checkbox" type="checkbox" id="breakfastCheckbox" name="meals[]"
                                value="B">
                            <label class="custom-label" for="breakfastCheckbox">Breakfast</label>
                        </div>
                        <div class="checkbox-group">
                            <input class="custom-checkbox" type="checkbox" id="lunchCheckbox" name="meals[]" value="L">
                            <label class="custom-label" for="lunchCheckbox">Lunch</label>
                        </div>
                        <div class="checkbox-group">
                            <input class="custom-checkbox" type="checkbox" id="dinnerCheckbox" name="meals[]" value="D">
                            <label class="custom-label" for="dinnerCheckbox">Dinner</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="information">Information:</label>
                    <textarea class="form-control long-textarea" id="information" name="information[]" required></textarea>
                </div>
                <button type="button" class="btn btn-danger deleteRow">Delete</button>
            </div>`;

            // Append the new row below the first input group and above the submit button
            $('.firstRow:last').after(newRow);
        });

        // Handle delete row functionality
        $(document).on('click', '.deleteRow', function () {
            // Remove the entire row when delete button is clicked
            $(this).closest('.firstRow').remove();
            // Decrement the number of days counter when a row is deleted
            numOfDays--;
        });
    });


    //multi-step form
    $(document).ready(function () {
        var currentStep = 1;


        $('.nextButton').click(function () {
            // Validate current step fields here
            // If validation passes, move to the next step
            // ...

            // Move to the next step

            $('#' + 'step' + currentStep).hide();
            document.documentElement.scrollTop = 0;
            currentStep++;
            $('#' + 'step' + currentStep).show();

            // Show the previous button from the second step onwards
            if (currentStep > 1) {
                $('#' + 'step' + currentStep + ' .previousButton').show();
            }



        });

        $('.previousButton').click(function () {
            // Move to the previous step
            $('#' + 'step' + currentStep).hide();
            currentStep--;
            $('#' + 'step' + currentStep).show();

            // Hide the previous button in the first step
            if (currentStep === 1) {
                $('#' + 'step' + currentStep + ' .previousButton').hide();
            }
        });

        $('.submitButton').click(function () {
            // Handle form submission here
            // ...
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