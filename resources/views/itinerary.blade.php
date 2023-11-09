@extends('layouts.customers.app')

@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <section id="page-title" class="text-light" style="background-image:url(images/newHeader.jpg);
            background-size: cover; background-position: center center;">
            <div class="container">
                <div class="page-title">
                    <h1>Packages</h1>
                </div>
            </div>
        </section>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary-tab-pane" type="button" role="tab" aria-controls="itinerary-tab-pane" aria-selected="true">ITINERARY</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="room-tab" data-bs-toggle="tab" data-bs-target="#room-tab-pane" type="button" role="tab" aria-controls="room-tab-pane" aria-selected="false">ROOM TYPE</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="remark-tab" data-bs-toggle="tab" data-bs-target="#remark-tab-pane" type="button" role="tab" aria-controls="remark-tab-pane" aria-selected="false">REMARK</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="departure-tab" data-bs-toggle="tab" data-bs-target="#departuredate-tab-pane" type="button" role="tab" aria-controls="departuredate-tab-pane" aria-selected="false">DEPARTURE DATE</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="itinerary-tab-pane" role="tabpanel" aria-labelledby="itinerary-tab">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="timeline">
                            <li class="timeline-item">
                                <div class="timeline-icon"><i class="icon-map"></i></div>
                                <p>
                                    <a class="btn btn btn-danger" href="{{ route('itinerary', [$package->itineraryPdf]) }}" target="_blank">
                                        <i class="icon-arrow-down-circle"></i>ITINERARY PDF 行程下载
                                    </a>
                                </p>
                            </li>
                            @foreach ($itineraries as $itinerary)
                                @if ($itinerary->packageID === $package->packageID)
                                    <li class="timeline-item">
                                        <div class="timeline-icon"><i class="icon-map-pin"></i></div>
                                        <h4>Day {{ $itinerary->noOfDays }} </h4><br>
                                        <p>Hotel Name: <strong>{{ $itinerary->hotelName }}</strong></p>
                                        <p>Meals: <strong>{{ $itinerary->meals }}</strong></p>
                                        <p>Information:<strong>{{ $itinerary->information }}</strong></p>
                                        <p style="font-family: Verdana, Arial, sans-serif; font-size: 10.847px; color: rgb(124, 81, 161);">
                                            Remarks:<strong>{{ $itinerary->remarks }}</strong>
                                        </p>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
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
                <p><b>Remarks: </b></p> {!! nl2br(e($package->remarks)) !!}
               </div>
               <br>
            </div>

            <div class="tab-pane fade" id="departuredate-tab-pane" role="tabpanel" aria-labelledby="departure-tab">
                <!-- DEPARTURE DATE CONTENT -->
            </div>
        </div>
    </div>
@endsection
