@extends('layouts.app', [
'class' => '',
'elementActive' => 'tables'
])

@section('content')
<div class="content"> <div class="col-md-12"> <!-- Package Details -->
    <div class="card">
    <div class="card-body">
    <h5 style="float:left">Package Details</h5>
    <a href="{{ URL::previous() }}" class="btn btn-secondary" style="float:right; top:0px">Back</a>
    <table class="table">
    <tbody>
    <tr>
        <th scope="row">Package Name</th>
        <td>{{ $package->packageName }}</td>
    </tr>
    <tr>
        <th scope="row">Destination</th>
        <td>{{ $package->destination }}</td>
    </tr>
    <tr>
        <th scope="row">Package Image</th>
        <td>{{ $package->packageImage }}</td>
    </tr>
    <tr>
        <th scope="row">Itinerary(PDF)</th>
        <td>{{ $package->itineraryPdf }}</td>
    </tr>
    <tr>
        <th scope="row">Highlight</th>
        <td>{!! nl2br(e($package->highlight)) !!}</td>
        
    </tr>
    <tr>
        <th scope="row">Package Remark</th>
        <td>{!! nl2br(e($package->remarks)) !!}</td>
        
    </tr>
    <tr>
        <th scope="row">Single Room</th>
        <td>RM {{ $package->singleRoom }}</td>
    </tr>
    <tr>
        <th scope="row">Double Room</th>
        <td>RM {{ $package->doubleRoom }}</td>
    </tr>
    <tr>
        <th scope="row">Triple Room</th>
        <td>RM {{ $package->tripleRoom }}</td>
    </tr>
    
    </tbody>
    </table>
    </div>
</div>

<!-- Tour Details -->
<div class="card">
    <div class="card-body">
        <h5>Tour Details</h5>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>Tour Code</th>
                    <th>Languages</th>
                    <th>Tour Price</th>
                    <th>No Of Seats</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tours as $key => $tour)
                <tr>
                    <td>{{ $tour->tourCode }}</td>
                    <td>{{ $tour->tourLanguages }}</td>
                    <td>{{ $tour->tourPrice }}</td>
                    <td>{{ $tour->noOfSeats }}</td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tourModal{{ $key }}">Flight Details</button>
                    </td>
                </tr>
                <div class="modal fade" id="tourModal{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="tourModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tourModalLabel">Tour Code - {{ $tour->tourCode }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                @php
                $flight = \App\Models\Flight::where('flightID', $tour->flightID)->first();

                @endphp
                @if($flight)
                    <h6><strong>1. Outward Flight Details</strong></h6>
                    <hr>
                    <p><strong>Sector:</strong> {{ $flight->sector }}</p>
                    <p><strong>Airlines:</strong> {{ $flight->airlines }}</p>
                    <p><strong>Flight Number:</strong> {{ $flight->flightNumber }}</p>
                    <p><strong>Departure Date:</strong> {{ $flight->departureDate }}</p>
                    <p><strong>Departure Time:</strong> {{ $flight->departureTime }}</p>
                    <p><strong>Arrival Date:</strong> {{ $flight->arrivalDate }}</p>
                    <p><strong>Arrival Time:</strong> {{ $flight->arrivalTime }}</p>
                    <hr>
                    <h6><strong>2. Return Flight Details</strong></h6>
                    <hr>
                    <p><strong>Return Sector:</strong> {{ $flight->returnSector }}</p>
                    <p><strong>Return Airlines:</strong> {{ $flight->returnAirlines }}</p>
                    <p><strong>Return Flight Number:</strong> {{ $flight->returnFlightNumber }}</p>
                    <p><strong>Return Departure Date:</strong> {{ $flight->returnDepartureDate }}</p>
                    <p><strong>Return Departure Time:</strong> {{ $flight->returnDepartureTime }}</p>
                    <p><strong>Return Arrival Date:</strong> {{ $flight->returnArrivalDate }}</p>
                    <p><strong>Return Arrival Time:</strong> {{ $flight->returnArrivalTime }}</p>
                @else
                    <p>No flight details available.</p>
                @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Itinerary Details -->
<div class="card">
    <div class="card-body">
        <h5>Itinerary</h5>
        <hr>
            @foreach($itineraries as $itinerary)
            <div class="card" style="border:1px solid grey">
              <div class="card-body">
              <p><strong>Day: </strong>{{ $itinerary->noOfDays }}</p>
              <p><strong>Remarks: </strong>{{ $itinerary->remarks }}</p>
              <p><strong>Hotel: </strong>{{ $itinerary->hotelName }}</p>
              <p><strong>Information:</strong><br>{!! nl2br(e($itinerary->information)) !!}</p>


                </div>
             </div>
                <!-- Add more itinerary details as needed -->
                @endforeach
    </div>
</div>
</div>
</div>
@endsection