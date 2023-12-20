@extends('layouts.app', ['class' => '', 'elementActive' => 'booking'])

@section('content')

@php 
$bookedTour =  App\Models\Tour::where('tourCode', $tour->tourCode)->first();
$package = App\Models\Package::where('packageID', $bookedTour->packageID)->first();
@endphp

<div class="content">
    <div id="step1">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

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
                        <form onsubmit="return validateForm()"
                            action="{{ route('booking.update', $booking->bookingID) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div> <a href="{{ route('booking.index') }}" class="btn btn-secondary"
                                    style="float:right; top:0px">Back</a>

                                <div class="card-header" style="padding-left:0px"> <b>Update Booking<b>

                                </div>
                                <hr>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="bookingDate">Booking Date:</label>
                                        <input type="text" class="form-control" id="bookingDate"
                                            value="{{ $booking->bookingDate }}" name="bookingDate" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bookingID">Booking ID:</label>
                                        <input type="text" class="form-control" id="bookingID"
                                            value="{{ $booking->bookingID }}" name="bookingID" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="destination">Package Name:</label>
                                        <input type="text" class="form-control" id="packageName"
                                            value="{{ $package->packageName }}" name="packageName" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bookingID">Tour Code:</label>
                                        <input type="text" class="form-control" id="tourCode"
                                            value="{{ $tour->tourCode }}" name="tourCode" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="destination">Customer Name:</label>
                                        <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                            name="name" readonly>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="bookingID">Contact No:</label>
                                        <input type="text" class="form-control" id="phoneNo"
                                            value="{{ $user->phoneNo }}" name="phoneNo" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <div id="noOfPeople" class="row">
                                            <div class="room-type col-md-4">
                                                <label for="noOfAdult">Adult(s):</label>

                                                <div class="input-group">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfAdult', -1)">-</button>
                                                    <input type="number" class="form-control" style="text-align:center"
                                                        id="noOfAdult" name="noOfAdult"
                                                        value="{{ $booking->noOfAdult }}">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfAdult', 1)">+</button>
                                                </div>
                                                @error('noOfAdult')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="room-type col-md-4">
                                                <label for="noOfChild">Child/Children:</label>

                                                <div class="input-group">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfChild', -1)">-</button>
                                                    <input type="number" class="form-control" style="text-align:center"
                                                        id="noOfChild" name="noOfChild"
                                                        value="{{ $booking->noOfChild }}">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfChild', 1)">+</button>
                                                </div>
                                                @error('noOfChild')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="room-type col-md-4">
                                                <label for="noOfInfant">Infant(s):</label>

                                                <div class="input-group">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfInfant', -1)">-</button>
                                                    <input type="number" class="form-control" style="text-align:center"
                                                        id="noOfInfant" name="noOfInfant"
                                                        value="{{ $booking->noOfInfant }}">
                                                    <button type="button"
                                                        onclick="updateQuantity('noOfInfant', 1)">+</button>
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
                                                    <button type="button"
                                                        onclick="updateQuantity('{{ $roomType }}', -1)">-</button>
                                                    <input type="number" class="form-control" style="text-align:center"
                                                        id="{{ $roomType }}" name="noOfRoom[{{ $roomType }}]"
                                                        value="{{ $count }}">
                                                    <button type="button"
                                                        onclick="updateQuantity('{{ $roomType }}', 1)">+</button>
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
                                    <textarea class="form-control long-textarea" id="bookingRemarks"
                                        name="bookingRemarks">{{$booking->bookingRemarks}}</textarea>
                                    @error('bookingRemarks')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Update </button>
                            </div>

                            <input type="hidden" id="bookingAmount" name="bookingAmount" value="{{ $booking->bookingAmount }}">
                            <input type="hidden" id="bookingDeposit" name="bookingDeposit" value="{{ $booking->bookingDeposit }}">
                   
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 order-md-last card">
        <h4 class="d-flex justify-content-between align-items-center mb-8">
    <span class="font-weight-bold text-uppercase" >
        Booking Summary
    </span>
</h4>
    <ul id="bookingSummaryList" class="list-group mb-3"></ul>
</div>
        </div>
    </div>
 </div>



        <script>
    function updateQuantity(type, delta) {
        const inputField = document.getElementById(type);
        const currentValue = parseInt(inputField.value, 10) || 0;
        const newValue = currentValue + delta;

        if (newValue >= 0 && newValue <=12) {
            inputField.value = newValue;
            updateBookingSummary();
        }
    }

    function updateBookingSummary() {
        var noOfAdult = parseInt(document.getElementById('noOfAdult').value);
    var noOfChild = parseInt(document.getElementById('noOfChild').value);
    var noOfInfant = parseInt(document.getElementById('noOfInfant').value);
     var singleRoom = parseInt(document.getElementById('Single Room').value);
     var doubleRoom = parseInt(document.getElementById('Double Room').value);
     var tripleRoom = parseInt(document.getElementById('Triple Room').value);

    // Assume these are the exchange rates from RM to other currencies

    var lowestTourPrice = {{ $bookedTour->tourPrice }};
    var singleRoomPrice = {{ $package->singleRoom }};
    var doubleRoomPrice = {{ $package->doubleRoom }};
    var tripleRoomPrice = {{ $package->tripleRoom }};    

    var roomDetails = {
        'Adult': { quantity: noOfAdult, price: lowestTourPrice },
        'Child': { quantity: noOfChild, price: lowestTourPrice }, 
        'Infant': { quantity: noOfInfant, price: 0 }, 
        'Single<br>Room(s)': { quantity: singleRoom, price: singleRoomPrice },
        'Double<br>Room(s)': { quantity: doubleRoom, price: doubleRoomPrice },
        'Triple<br>Room(s)': { quantity: tripleRoom, price: tripleRoomPrice }
    };

    var bookingSummaryList = document.getElementById('bookingSummaryList');
    bookingSummaryList.innerHTML = '';

    var totalAmount = 0;

    for (var roomType in roomDetails) {
        var quantity = roomDetails[roomType].quantity;
        var price = roomDetails[roomType].price;

        if (quantity > 0) {
            var subtotal = quantity * price;
            totalAmount += subtotal;

            var listItem = document.createElement('li');
            listItem.className = 'list-group-item d-flex justify-content-between lh-sm';
            listItem.innerHTML = `
                <div>
                    <h6 class="my-0">${roomType}</h6>
                    
                    <span class="text-muted">RM ${price.toFixed(2)} X <b>${quantity}</b></span>
                </div>
                <span class="text-muted">RM ${subtotal.toFixed(2)}</span>
            `;

            bookingSummaryList.appendChild(listItem);
        }
    }

    var totalAmountElement = document.createElement('li');
    totalAmountElement.className = 'list-group-item d-flex justify-content-between';
    totalAmountElement.innerHTML = `
    <div class="row">
    <div class="col-md-12">
        <strong>Deposit (30%) = </strong>
        <span style="color:red" id="totalAmount"><b>RM ${(0.3 * totalAmount).toFixed(2)}</b></span>
    </div>
    <div class="col-md-12">
        <strong>Total = </strong>
        <span style="color:red" id="totalAmount"><b>RM ${totalAmount.toFixed(2)}</b></span>
    </div>

        <input type="hidden" name="bookingAmount" value="${totalAmount.toFixed(2)}">
        <input type="hidden" name="bookingDeposit" value="${(0.3 * totalAmount).toFixed(2)}">
    `;

    document.getElementById('bookingAmount').value = totalAmount.toFixed(2);
    document.getElementById('bookingDeposit').value = (0.3 * totalAmount).toFixed(2);
    bookingSummaryList.appendChild(totalAmountElement);
}

updateBookingSummary();
        </script>


        @endsection