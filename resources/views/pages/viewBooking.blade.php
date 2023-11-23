@extends('layouts.app', [
'class' => '',
'elementActive' => 'tables'
])

@section('content')
<div class="content"> <div class="col-md-12"> <!-- Package Details -->
@if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
    <div class="card-body">
    <h5 style="float:left">Booking Details</h5>
    <a href="{{ route('booking.index') }}" class="btn btn-secondary" style="float:right; top:0px">Back</a>
    
    <table class="table">
    <tbody>
    <tr>
        <th scope="row">Booking ID</th>
        <td>{{ $booking->bookingID }}</td>
    </tr>
    <tr>
        <th scope="row">Booking Date</th>
        <td>{{ $booking->bookingDate }}</td>
    </tr>
    <tr>
        <th scope="row">Package Name</th>
        <td>{{ $package->packageName }}</td>
    </tr>
    <tr>
        <th scope="row">Tour Code</th>
        <td>{{ $tour->tourCode }}</td>
    </tr>
    <tr>
        <th scope="row">No of Adult</th>
        <td>{{ $booking->noOfAdult }}</td>
    </tr>
    <tr>
        <th scope="row">No of Child</th>
        <td>{{ $booking->noOfChild }}</td>
    </tr>
    <tr>
        <th scope="row">No of Infant</th>
        <td>{{ $booking->noOfInfant }}</td>
        
    </tr>
    @php
    $noOfRooms = unserialize($booking->noOfRoom);
    $suitableRooms = unserialize($booking->typesOfRoom);
    $roomCounts = ['Single Room' => 0, 'Double Room' => 0, 'Triple Room' => 0];

    $roomQuantities = [];
    $roomTypes = array_unique($suitableRooms);

    foreach ($suitableRooms as $room) {
        $roomCounts[$room]++;
    }
@endphp

<tr>
    <th scope="row">Room Details</th>
    @if($booking->bookingStatus === "Room Pending")
    <td style="color:red">
        @foreach ($roomCounts as $roomType => $count) 
            {{ $roomType }} x {{ $count }}<br>
            @php
                $roomQuantities[$roomType] = $count;
            @endphp
        @endforeach
    </td>
    @else
    <td>
        @foreach ($roomCounts as $roomType => $count) 
            {{ $roomType }} x {{ $count }}<br>
            @php
                $roomQuantities[$roomType] = $count;
            @endphp
        @endforeach
    </td>
    @endif

</tr>

<tr>
        <th scope="row">Booking Remarks</th>
        <td style="color:red">{!! nl2br(e($booking->bookingRemarks)) !!}</td>
        
    </tr>
    <tr>
        <th scope="row">Booking Status</th>
        <td style="color:red">{{$booking->bookingStatus}}</td>
        
    </tr>

    <tr>
        <th scope="row">Booking Amount</th>
        <td>RM {{ $booking->bookingAmount }}</td>
    </tr>
    <tr>
        <th scope="row">Booking Deposit</th>
        <td>RM {{ $booking->bookingDeposit }}</td>
    </tr>

    
    </tbody>
    </table>
    <a href="{{ route('booking.edit', $booking->bookingID) }}" class="btn btn-danger" style="float:right; margin-right: 10px;">Edit</a>

    </div>
</div>


@endsection