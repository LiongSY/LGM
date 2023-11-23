@extends('layouts.customers.app')

@section('content')

    <div class="container" style="margin-top:9%">

                <div class="page-title">
                    <h1>Packages</h1>
                </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary-tab-pane" type="button" role="tab" aria-controls="itinerary-tab-pane" aria-selected="true" ><b>ITINERARY</b></button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="room-tab" data-bs-toggle="tab" data-bs-target="#room-tab-pane" type="button" role="tab" aria-controls="room-tab-pane" aria-selected="false"><b>ROOM TYPE</b></button> <br>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="remark-tab" data-bs-toggle="tab" data-bs-target="#remark-tab-pane" type="button" role="tab" aria-controls="remark-tab-pane" aria-selected="false"><b>REMARK</b></button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="departure-tab" data-bs-toggle="tab" data-bs-target="#departuredate-tab-pane" type="button" role="tab" aria-controls="departuredate-tab-pane" aria-selected="false"><b>DEPARTURE DATE</b></button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="itinerary-tab-pane" role="tabpanel" aria-labelledby="itinerary-tab">
                <div class="row"><br>
                    <div class="col-lg-12">
                                <p>
                                    <a class="btn btn btn-danger" href="{{ route('itinerary', [$package->itineraryPdf]) }}" target="_blank">
                                       <i class="icon-arrow-down-circle"></i>ITINERARY PDF 行程下载
                                    </a>
                                </p>
                            @foreach ($itineraries as $itinerary)
                                @if ($itinerary->packageID === $package->packageID)
                                        <h4><i class="bi bi-geo-alt" style="color:blue;"></i>
                                        <b> Day {{ $itinerary->noOfDays }} :</b>
                                        <p style="color:red; display:inline;"> {{ $itinerary->remarks }}<p></h4>
                                        <div class="card" style="border:1px solid grey; padding:15px">
                                        <p><strong>Hotel Name: </strong>  {{ $itinerary->hotelName }}</p>
                                        <p><strong>Meals: </strong> {{ $itinerary->meals }}</p>
                                        <p><strong>Information:<br></strong>{!! nl2br(e($itinerary->information)) !!}</p>
                                       
                                        </div>
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="room-tab-pane" role="tabpanel" aria-labelledby="room-tab">
    <div class="row">
        <div class="col-md-12">
            <div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Single Room</th>
                            <td>{{ $package->singleRoom }}</td>
                        </tr>
                        <tr>
                            <th>Double Room</th>
                            <td>{{ $package->doubleRoom }}</td>
                        </tr>
                        <tr>
                            <th>Triple Room</th>
                            <td>{{ $package->tripleRoom }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <font color="red">*</font> NOTE:
                                <div style="padding: 15px;">
                                    <ol>
                                        <li>Based on Standard Twin Room (2 x single beds) with an additional roller bed</li>
                                        <li>Movement may be constricted due to additional bed in the room</li>
                                        <li>If Triple Sharing Room is not available, a Standard Twin Room plus a Standard Single Room will be arranged. Surcharges apply.</li>
                                        <li>May not be allowed / recommended for selected tour packages</li>
                                    </ol>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane fade" id="remark-tab-pane" role="tabpanel" aria-labelledby="remark-tab">
                <!-- REMARK CONTENT -->
                <div>
                  <br>
                <p><b style="color:red;">Remarks: </b>
            </p> {!! nl2br(e($package->remarks)) !!}
               </div>
               <br>
            </div>

<div class="tab-pane fade" id="departuredate-tab-pane" role="tabpanel" aria-labelledby="departure-tab">
    <!-- DEPARTURE DATE CONTENT -->

    <div class="row">
        <div class="col-lg-12">
            <!-- Tour Details Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Tour Details</th>
                        <th class="text-center">Flight Number</th>
                        <th class="text-center">Sector</th>
                        <th class="text-center">Date</th>
                    </tr>
                </thead>
              <tbody>
    @foreach($tours as $key => $tour)
        <tr>
            <td>
                <strong>Tour Code:</strong> {{ $tour->tourCode }}<br>
                <strong>Tour Languages:</strong> {{ $tour->tourLanguages }}<br>
                <strong>Tour Price:</strong> {{ $tour->tourPrice }}<br>
                <strong>Tour Status:</strong> {{ $tour->tourStatus }}<br>
                <strong>No. of Seats:</strong> {{ $tour->noOfSeats }}
            </td>
            <td>
                <b style="color:red;">Outbound:</b> {{ $flightDetails[$key]->flightNumber }}<br>
                <b style="color:blue;">Return:</b> {{ $flightDetails[$key]->returnFlightNumber}}
            </td>
            <td>
            <b style="color:red;">Outbound:</b> {{ $flightDetails[$key]->sector }}<br>
            <b style="color:blue;">Return:</b> {{ $flightDetails[$key]->returnSector }}
            </td>

            <td>
                <b style="color:red;">Outbound:</b><br>
                <div style="display: flex; flex-direction: row;">
                    <div style="margin-right: 10px;">
                    <div>
                        <strong>Date/Time:</strong><br>
                        Departure: {{ $flightDetails[$key]->departureDate }} &nbsp; {{ $flightDetails[$key]->departureTime }}<br>
                        Arrival: {{ $flightDetails[$key]->arrivalDate }} &nbsp;{{ $flightDetails[$key]->arrivalTime }}
                    </div>
                    </div>
                </div><br>
                <b style="color:blue;">Return:</b><br>
                <div style="display: flex; flex-direction: row;">
                    <div style="margin-right: 10px;">
                    <div>
                        <strong>Date/Time:</strong><br>
                        Departure: {{ $flightDetails[$key]->returnDepartureDate }} &nbsp; {{ $flightDetails[$key]->returnDepartureTime }}<br>
                        Arrival: {{ $flightDetails[$key]->returnArrivalDate }} &nbsp;{{ $flightDetails[$key]->returnArrivalTime }}
                    </div>
                    </div>
                </div>
               
                <div style="margin-top: 10px;">
                <a href="{{ route('booking')}}">
                <button class="btn btn-primary" style="color:white; background-color:deepblue; transition:background-color 0.3s;">Book Now</button>
            </div>
            </td>
        </tr>
    @endforeach
</tbody>

            </table>
        </div>

       
    </div>

</div>

</div>

        </div>
@endsection
