@extends('layouts.app', ['class' => '', 'elementActive' => 'booking'])

@section('content')

<div class="content"> <div id="step1"> <div class="row">
    <div class="col-md-8"> <div class="card">

        <div class="card-body">
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
            <!-- Form for Packages Management -->
            <form onsubmit="return validateForm()" action="{{ route('booking.update', $booking->bookingID) }}" method="POST">
                @csrf
                @method('PUT')
                <div>    <a href="{{ route('booking.index') }}" class="btn btn-secondary" style="float:right; top:0px">Back</a>

                    <div class="card-header" style="padding-left:0px"> <b>Update Booking<b>
                        
                    </div>
                    <hr>
                    <div class="form-row">                    
                        <div class="form-group col-md-6">
                            <label for="bookingDate">Booking Date:</label>
                            <input type="text" class="form-control" id="bookingDate" value="{{ $booking->bookingDate }}" name="bookingDate" readonly>
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label for="bookingID">Booking ID:</label>
                        <input type="text" class="form-control" id="bookingID" value="{{ $booking->bookingID }}" name="bookingID" readonly>
                    </div>
                    </div>
                    <div class="form-row">                    
                        <div class="form-group col-md-6">
                            <label for="destination">Package Name:</label>
                            <input type="text" class="form-control" id="packageName" value="{{ $package->packageName }}" name="packageName" readonly>
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label for="bookingID">Tour Code:</label>
                        <input type="text" class="form-control" id="tourCode" value="{{ $tour->tourCode }}" name="tourCode" readonly>
                    </div>
                    </div>
                    <div class="form-row">                    
                        <div class="form-group col-md-6">
                            <label for="destination">Customer Name:</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" name="name" readonly>
                        </div>
                    
                    <div class="form-group col-md-6">
                        <label for="bookingID">Contact No:</label>
                        <input type="text" class="form-control" id="phoneNo" value="{{ $user->phoneNo }}" name="phoneNo" readonly>
                    </div>
                    </div>
                    <div class="form-row">
<div class="form-group col-md-12">
      <div id="noOfPeople" class="row">
        <div class="room-type col-md-4">
            <label for="noOfAdult">Adult(s):</label>

            <div class="input-group">
                <button type="button" onclick="updateQuantity('noOfAdult', -1)">-</button>
                <input type="number" class="form-control" style="text-align:center" id="noOfAdult" name="noOfAdult" value="{{ $booking->noOfAdult }}" >
                <button type="button" onclick="updateQuantity('noOfAdult', 1)">+</button>
            </div>
            @error('noOfAdult')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="room-type col-md-4">
            <label for="noOfChild">Child/Children:</label>

            <div class="input-group">
                <button type="button" onclick="updateQuantity('noOfChild', -1)">-</button>
                <input type="number" class="form-control" style="text-align:center" id="noOfChild" name="noOfChild" value="{{ $booking->noOfChild }}" >
                <button type="button" onclick="updateQuantity('noOfChild', 1)">+</button>
            </div>
            @error('noOfChild')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="room-type col-md-4">
            <label for="noOfInfant">Infant(s):</label>

            <div class="input-group">
                <button type="button" onclick="updateQuantity('noOfInfant', -1)">-</button>
                <input type="number" class="form-control" style="text-align:center" id="noOfInfant" name="noOfInfant" value="{{ $booking->noOfInfant }}" >
                <button type="button" onclick="updateQuantity('noOfInfant', 1)">+</button>
            </div>
            @error('noOfInfant')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
    </div>
</div>
</div>


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
<div class="form-row">
<div class="form-group col-md-12">
      <div id="roomSelection" class="row">
        @foreach ($roomCounts as $roomType => $count)
        <div class="room-type col-md-4">
            <label for="{{ $roomType }}">{{ $roomType }}:</label>
            <div class="input-group">
                <button type="button" onclick="updateQuantity('{{ $roomType }}', -1)">-</button>
                <input type="number" class="form-control" style="text-align:center" id="{{ $roomType }}" name="noOfRoom[{{ $roomType }}]" value="{{ $count }}" >
                <button type="button" onclick="updateQuantity('{{ $roomType }}', 1)">+</button>
            </div>
            @error('noOfRoom.'.$roomType)
                    <div class="text-danger">{{ $message }}</div>
                @enderror
        </div>
        @endforeach
    </div>
</div>
</div>
                    <div class="form-group">
                        <label for="remarks">Remarks for the booking:</label>
                        <textarea class="form-control long-textarea" id="bookingRemarks" name="bookingRemarks" >{{$booking->bookingRemarks}}</textarea>
                        @error('bookingRemarks')
            <span class="text-danger">{{ $message }}</span>
        @enderror
                    </div>

                    
                        <button type="submit" class="btn btn-primary">Update </button>
                    </div>
                </div>
            </form>

        </div>

    </div>

</div>



<script>
        function updateQuantity(roomType, change) {
        const inputElement = document.getElementById(roomType);
        const currentValue = parseInt(inputElement.value, 10) || 0;
        const newValue = currentValue + change;

        if (newValue >= 0) {
            inputElement.value = newValue;
        }
    }

</script>


@endsection