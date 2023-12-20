<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>User Preferences</title>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .preference-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preference-option {
            border: 2px solid #ccc;
            padding: 10px;
            cursor: pointer;
            transition: border-color 0.3s ease-in-out;
        }

        .preference-option.selected {
            border-color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">Let us know more about you!</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('user-preference.store') }}">
                            @csrf

                            <div class="form-group">

                                <label>Preferred Season:</label>
                                <div class="row">
                                    <input type="hidden" name="preferredSeason" id="preferredSeasonInput">
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="preferredSeason" data-value="Love winter season">Winter</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)"data-question="preferredSeason" data-value="Love summer season">Summer</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)"data-question="preferredSeason" data-value="Love spring season">Spring</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)"data-question="preferredSeason" data-value="Love fall season">Fall</div>
                                </div>
                                @error('preferredSeason')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">

                                <label>Activity Level:</label>
                                <div class="row">
                                <input type="hidden" name="activityLevel" id="activityLevelInput">
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="activityLevel" data-value="Want to have a relax trip">Relaxing on the beach</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="activityLevel" data-value="Love to explore different culture">Exploring cultural attractions</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="activityLevel" data-value="Enjoy take photos during vacation">Enjoy taking photos</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="activityLevel" data-value="Love to shop during travel">Love to shop</div>
                                </div>
                                @error('activityLevel')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Accommodation Style -->
                            <div class="form-group">

                                <label>Accommodation Style:</label>
                                <div class="row">
                                <input type="hidden" name="accomodationStyle" id="accomodationStyleInput">
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="accomodationStyle" data-value="Love luxury hotels">Luxury hotels</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="accomodationStyle" data-value="Love nice view hotels">Nice View hotels</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="accomodationStyle" data-value="Love traditional hotels">Traditional hotels</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="accomodationStyle" data-value="Love budget hotels">Budget-friendly hostels</div>
                                </div>
                                @error('accomodationStyle')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Preferred Destinations -->
                            <div class="form-group">

                                <label>Preferred Destinations:</label>
                                <div class="row">
                                <input type="hidden" name="destination" id="destinationInput">
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="destination" data-value="Love to see flowers">Flowers</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="destination" data-value="Love historical and cultural cities">Historical/cultural cities</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="destination" data-value="Love places with mountains">Mountainous regions</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="destination" data-value="Love urban cities">Urban Cities</div>
                                </div>
                                @error('destination')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Travel Group -->
                            <div class="form-group">

                                <label>Travel Group:</label>
                                <div class="row">
                                <input type="hidden" name="travelGroup" id="travelGroupInput">
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="travelGroup" data-value="Always travel alone">Solo travel</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="travelGroup"  data-value="Travel with spouse or partner">With a partner or spouse</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="travelGroup"  data-value="Travel with family">Family travel</div>
                                    <div class="col-sm-3 preference-option" onclick="toggleSelection(this)" data-question="travelGroup" data-value="Travel with friends">Group travel with friends</div>
                                </div>
                                @error('travelGroup')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var preferenceOptions = document.querySelectorAll('.preference-option');

            preferenceOptions.forEach(function (option) {
                option.addEventListener('click', function () {
                    var row = option.parentElement;
                    var options = row.getElementsByClassName('preference-option');
                    for (var i = 0; i < options.length; i++) {
                        options[i].classList.remove('selected');
                    }

                    option.classList.add('selected');

                    var question = option.getAttribute('data-question');
                    var value = option.getAttribute('data-value');

                    document.getElementById(question + 'Input').value = value;
                });
            });
        });
    </script>
</body>

</html>
