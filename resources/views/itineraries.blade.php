@extends('layouts.customers.app')

@section('content')
@php
$selectedCurrency = Session::get('selectedCurrency', 'MYR');
$usdRate = Session::get('USDRate', 1);
$sgdRate = Session::get('SGDRate', 1);
$bndRate = Session::get('BNDrate', 1);
@endphp



<div>
<img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="100%" height="700"
                src="{{ asset('images/packagesHeader.png') }}" preserveAspectRatio="xMidYMid slice" focusable="false">
    <div>

<div class="container" style="margin-top:4%;">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary-tab-pane"
                type="button" role="tab" aria-controls="itinerary-tab-pane"
                aria-selected="true"><b>ITINERARY</b></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="room-tab" data-bs-toggle="tab" data-bs-target="#room-tab-pane" type="button"
                role="tab" aria-controls="room-tab-pane" aria-selected="false"><b>ROOM TYPE</b></button> <br>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="remark-tab" data-bs-toggle="tab" data-bs-target="#remark-tab-pane"
                type="button" role="tab" aria-controls="remark-tab-pane" aria-selected="false"><b>REMARK</b></button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="departure-tab" data-bs-toggle="tab" data-bs-target="#departuredate-tab-pane"
                type="button" role="tab" aria-controls="departuredate-tab-pane" aria-selected="false"><b>DEPARTURE
                    DATE</b></button>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="itinerary-tab-pane" role="tabpanel" aria-labelledby="itinerary-tab">
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <p style="margin-bottom:30px">

                        <a class="btn btn btn-danger" href="{{ route('generateItinerary', $package->packageID) }}"
                            target="_blank">
                            <i class="icon-arrow-down-circle"></i>DOWNLOAD ITINERARY
                        </a>
                    </p>
                    @foreach ($itineraries as $itinerary)
                    @if ($itinerary->packageID === $package->packageID)
                    <h4 class="custom-animated-heading" style="background-color:#D8F2F4; padding:5px; border-radius:10px" >
                        <i class="bi bi-geo-alt" style="color:#2A6D3A;"></i>
                        <b> Day {{ $itinerary->noOfDays }} :</b>
                        <p class="custom-animated-paragraph">
                            {{ $itinerary->remarks }}
                        </p>
                    </h4>
                    <div class="card animated-card" style="background:#faf9f7;">
                        <p><strong>Hotel Name: </strong> {{ $itinerary->hotelName }}</p>
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
                                    
                                    <td>@if($selectedCurrency === 'USD')
                                USD {{ number_format($package->singleRoom * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($package->singleRoom * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($package->singleRoom * $bndRate, 2) }}
                            @else
                                RM {{ number_format($package->singleRoom, 2) }}
                            @endif</td>
                                </tr>
                                <tr>
                                    <th>Double Room</th>
                                    <td>@if($selectedCurrency === 'USD')
                                USD {{ number_format($package->doubleRoom * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($package->doubleRoom * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($package->doubleRoom * $bndRate, 2) }}
                            @else
                                RM {{ number_format($package->doubleRoom, 2) }}
                            @endif</td>
                                </tr>
                                <tr>
                                    <th>Triple Room</th>
                                    <td>@if($selectedCurrency === 'USD')
                                USD {{ number_format($package->tripleRoom * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($package->tripleRoom * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($package->tripleRoom * $bndRate, 2) }}
                            @else
                                RM {{ number_format($package->tripleRoom, 2) }}
                            @endif</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <font color="red">*</font> NOTE:
                                        <div style="padding: 15px;">
                                            <ol>
                                                <li>Based on Standard Twin Room (2 x single beds) with an additional
                                                    roller bed</li>
                                                <li>Movement may be constricted due to additional bed in the room</li>
                                                <li>If Triple Sharing Room is not available, a Standard Twin Room plus a
                                                    Standard Single Room will be arranged. Surcharges apply.</li>
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
                                    <strong>Tour Price:</strong>  @if($selectedCurrency === 'USD')
                                USD {{ number_format($tour->tourPrice * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($tour->tourPrice * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($tour->tourPrice * $bndRate, 2) }}
                            @else
                                RM {{ number_format($tour->tourPrice, 2) }}
                            @endif<br>
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
                                                Departure: {{ $flightDetails[$key]->departureDate }} &nbsp; {{
                                                $flightDetails[$key]->departureTime }}<br>
                                                Arrival: {{ $flightDetails[$key]->arrivalDate }} &nbsp;{{
                                                $flightDetails[$key]->arrivalTime }}
                                            </div>
                                        </div>
                                    </div><br>
                                    <b style="color:blue;">Return:</b><br>
                                    <div style="display: flex; flex-direction: row;">
                                        <div style="margin-right: 10px;">
                                            <div>
                                                <strong>Date/Time:</strong><br>
                                                Departure: {{ $flightDetails[$key]->returnDepartureDate }} &nbsp; {{
                                                $flightDetails[$key]->returnDepartureTime }}<br>
                                                Arrival: {{ $flightDetails[$key]->returnArrivalDate }} &nbsp;{{
                                                $flightDetails[$key]->returnArrivalTime }}
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin-top: 10px;">
                                        <a href="{{ route('booking', ['id' => $tour->tourCode]) }}"
                                            class="btn btn-info">BOOK NOW</a>
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