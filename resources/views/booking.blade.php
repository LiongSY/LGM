@extends('layouts.customers.app')

@section('content')
<div style="margin-top:9%; margin-right:30px; margin-left:30px">
<form  action="{{ route('customerBooking') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="tourCode" value="{{ $tour->tourCode }}">

    <main>
        <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="badge bg-primary rounded-pill">Booking Summary</span>
    </h4>
    <ul id="bookingSummaryList" class="list-group mb-3"></ul>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="badge bg-primary rounded-pill">Remarks</span>
    </h4>
    <textarea class="form-control long-textarea" id="bookingRemarks" placeholder="Please write your remarks here ..." name="bookingRemarks" style="overflow:hidden; padding:5px; height:200px;margin-bottom:15px"></textarea>
</div>

            <div class="col-md-7 col-lg-8">
                <h2 class="mb-3" style="border-radius:15px; text-align:center"><strong>{{$package->packageName}}</strong></h2>
                <div style="border:1px solid #eaebeb; border-radius:10px; padding:15px">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div id="noOfPeople" class="row">
                                <div class="room-type col-md-2">
                                    <label for="noOfAdult"><strong>Adult(s):</strong></label>

                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('noOfAdult', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center"
                                            id="noOfAdult" name="noOfAdult" value="1" readonly>
                                        <button type="button" onclick="updateQuantity('noOfAdult', 1)">+</button>
                                    </div>
                                    @error('noOfAdult')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="room-type col-md-2">
                                    <label for="noOfChild"><strong>Child(s)</strong></label>

                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('noOfChild', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center"
                                            id="noOfChild" name="noOfChild" value="0" readonly>
                                        <button type="button" onclick="updateQuantity('noOfChild', 1)">+</button>
                                    </div>
                                    @error('noOfChild')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="room-type col-md-2">
                                    <label for="noOfInfant"><strong>Infant(s):</strong></label>

                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('noOfInfant', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center"
                                            id="noOfInfant" name="noOfInfant" value="0" readonly>
                                        <button type="button" onclick="updateQuantity('noOfInfant', 1)">+</button>
                                    </div>
                                    @error('noOfInfant')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="room-type col-md-2">
                                    <label for="singleRoom"><strong>Single Room:</strong></label>
                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('singleRoom', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center;"
                                            id="singleRoom" name="noOfRoom[Single Room]" value="0" readonly>
                                        <button type="button" onclick="updateQuantity('singleRoom', 1)">+</button>
                                    </div>
                                    @error('noOfRoom.singleRoom')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="room-type col-md-2">
                                    <label for="doubleRoom"><strong>Double Room:</strong></label>
                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('doubleRoom', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center;"
                                            id="doubleRoom" name="noOfRoom[Double Room]" value="0" readonly>
                                        <button type="button" onclick="updateQuantity('doubleRoom', 1)">+</button>
                                    </div>
                                    @error('noOfRoom.doubleRoom')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="room-type col-md-2">
                                    <label for="tripleRoom"><strong>Triple Room:</strong></label>
                                    <div class="input-group">
                                        <button type="button" onclick="updateQuantity('tripleRoom', -1)">-</button>
                                        <input type="number" class="form-control" style="text-align:center"
                                            id="tripleRoom" name="noOfRoom[Triple Room]" value="0" readonly>
                                        <button type="button" onclick="updateQuantity('tripleRoom', 1)">+</button>
                                    </div>
                                    @error('noOfRoom.tripleRoom')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="terms-and-conditions" style="border:1px solid #eaebeb; border-radius:10px; padding:15px; margin-bottom:5px;margin-top:20px">
        <h5><strong>Terms and Conditions:</strong></h5>
        <ol>
            <li>If you change to other currency like <span style="color:red"><b>USD, SGD, and BND</b></span>, it is for reference purposes only. The agent will collect the money in MYR.</li>
            <li>Please ensure that the tour package, schedule, and flight details are correct.<br><b style="color:blue;">Package Name: {{$package->packageName}}<br>Tour Code: {{$tour->tourCode}}<br>Departure Date: {{$flight->departureDate}}</b></li>
            <li>The tour will be conducted in <b>{{ $tour->tourLanguages }}</b>.</li>
            <li>Our staff will contact you for payment after the booking has been approved.</li>
            <li>Booking cannot be cancelled after the booking has been approved.</li>
            <li>Tour member must ensure he/she is medically and physically fit for travel. Please disclose any physical, medical, or other special needs that require special attention at the time of booking.</li>

        </ol>
    </div>
    <button type="submit" class="btn btn-primary" style="float:right">Submit</button>

            </div>

        
    </main>
</form>
</div>


<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

<script src="form-validation.js"></script>


<scribe-shadow id="crxjs-ext"
    style="position: fixed; width: 0px; height: 0px; top: 0px; left: 0px; z-index: 2147483647; overflow: visible;"></scribe-shadow>


<script>
    function updateQuantity(type, delta) {
        const inputField = document.getElementById(type);
        const currentValue = parseInt(inputField.value, 10) || 0;
        const newValue = currentValue + delta;

        if (newValue >= 0) {
            inputField.value = newValue;
            updateBookingSummary();
        }
    }
    function updateBookingSummary() {
        var noOfAdult = parseInt(document.getElementById('noOfAdult').value);
        var noOfChild = parseInt(document.getElementById('noOfChild').value);
        var noOfInfant = parseInt(document.getElementById('noOfInfant').value);
        var singleRoom = parseInt(document.getElementById('singleRoom').value);
        var doubleRoom = parseInt(document.getElementById('doubleRoom').value);
        var tripleRoom = parseInt(document.getElementById('tripleRoom').value);

        var roomDetails = {
            'Adult': { quantity: noOfAdult, price: {{$tour->tourPrice}} },
            'Child': { quantity: noOfChild, price: {{$tour->tourPrice}} }, 
            'Infant': { quantity: noOfInfant, price: 0 }, 
            'Single<br>Room(s)': { quantity: singleRoom, price: {{$package->singleRoom}} },
            'Double<br>Room(s)': { quantity: doubleRoom, price:  {{$package->doubleRoom}} },
            'Triple<br>Room(s)': { quantity: tripleRoom, price: {{$package->tripleRoom}} }
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
                        
                        <span class="text-muted">RM${price.toFixed(2)} X <b>${quantity}<b></span>

                    </div>
                    <span class="text-muted">RM${subtotal.toFixed(2)}</span>
                `;

                bookingSummaryList.appendChild(listItem);
            }
        }

        var totalAmountElement = document.createElement('li');
        totalAmountElement.className = 'list-group-item d-flex justify-content-between';
        totalAmountElement.innerHTML = `
            <strong>Deposit</strong>
            <span style="color:red" id="totalAmount"><b>RM${(0.3 * totalAmount).toFixed(2)}</b></span><br>
            <strong>Total</strong>
            <span style="color:red" id="totalAmount"><b>RM${totalAmount.toFixed(2)}</b></span>
            <input type="hidden" name="bookingAmount" value="${totalAmount.toFixed(2)}">
            <input type="hidden" name="bookingDeposit" value="${(0.3 * totalAmount).toFixed(2)}">


        `;

        bookingSummaryList.appendChild(totalAmountElement);
    }

    updateBookingSummary(); 
</script>
@endsection