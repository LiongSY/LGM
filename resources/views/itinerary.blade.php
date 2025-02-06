<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $itinerary['country'] }}'s Itinerary</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LGM.png') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles go here */
        body {
            background-color: #f5f5f5;
        }

        .day-card {
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            cursor: pointer;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
        }

        .card-body {
            padding: 15px;
        }
    </style>
</head>
<div class="container d-print-none" > 
      <a href="{{route('searchItinerary')}}" style="float:left"class="btn btn-light border text-black-50 shadow-none">Back</a> 
  <a href="javascript:window.print()" style="float:right" class="btn btn-light border text-black-50 shadow-none"></i> Print</a> 
  <a class="btn btn-light border text-black-50 shadow-none" onclick="confirmRegenerate()">Regenerate Itinerary</a>
</div>
<body class="container mt-5" >
<div class="container" style="margin-top:10px">
        <img id="logo" src="{{ asset('images/LGMLH.png') }}" title="LGM" alt="LGM" width="100%"/> </div>
    </div>
    <hr class="my-4">
    <!-- Displaying Generated Itinerary -->
    @isset($itinerary)

    <p class="text-center"><strong>Destination:</strong> {{ $itinerary['country'] }}</p>
    <p class="text-center"><strong>Number of Days:</strong> {{ $itinerary['num_days'] }}</p>

    @foreach ($itinerary['days'] as $day)
    <div class="day-card card animated fadeInUp">
        <div class="card-header">
            <strong>Day {{ $day['day'] }}</strong>
        </div>
        <div class="card-body">
            @foreach ($day['recommendations'] as $recommendation)
            <p>
                   {{ $recommendation }}
            </p>
            @endforeach
        </div>
    </div>
    @endforeach
    @endisset

    @if($itinerary_status == False)
    <div class="day-card card animated fadeInUp">

    <div class="card-body">
            <p style="color:red">
            We are sorry, we don't have so much data yet.
            </p>
        </div>
    </div>
    @endif
    <h1 class="mt-5 text-center">Recommended Hotels</h1>

    @if (isset($recommendedHotels))
    <ul class="list-group" style="margin-bottom:20px">
        @foreach ($recommendedHotels as $hotel)
            <li class="list-group-item animated fadeInUp">
            MAPS:
                <a href="https://www.google.com/maps/search/{{ urlencode($hotel) }}" target="_blank" style="text-decoration:none">
                        {{ $hotel }}
                </a>
            </li>
        @endforeach
    </ul>
@endif



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function refreshPage() {
        location.reload(true);
    }

    function confirmRegenerate() {
        var confirmation = window.confirm("Are you sure you want to regenerate the itinerary?");
        if (confirmation) {
            refreshPage();
        }
    }
    </script>
</body>

</html>
