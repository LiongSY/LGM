@extends('layouts.customers.app')

@section('content')

<div class="container mt-3 mt-md-5">
    <h2 class="text-charcoal hidden-sm-down">Your Booking History</h2>
    <div class="row">
        <div class="col-12">
            <div class="list-group mb-5">
                @foreach($bookings as $booking)
                <div class="list-group-item p-3 bg-snow" style="position: relative;">
                    <div class="row w-100 no-gutters">
                        <div class="col-6 col-md">
                        <h6 class="text-green mb-0"><b style="color:blue;">Booking Date</b></h6>
                                <p class="text-green hidden-sm-down mb-0">{{ $booking->bookingDate}}</p>
                        </div>
                        <div class="col-6 col-md">
                            <h6 class="text-charcoal mb-0 w-100">Tour Code</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0"></p>  
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Booking Status</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">{{$booking->bookingStatus}}</p> 
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Booking Amount (RM)</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">RM {{$booking->bookingAmount}}</p> 
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Booking Deposit (RM)</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">RM {{$booking->bookingDeposit}}</p> 
                        </div>
                    </div>
                </div>
                @endforeach
<!-- 
                <div class="list-group-item p-3 bg-white">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-9 pr-0 pr-md-3">
                            <div class="alert p-2 alert-success w-100 mb-0">
                                <h6 class="text-green mb-0"><b>Booking Date</b></h6>
                                <p class="text-green hidden-sm-down mb-0">{{ $booking->bookingDate}}</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

@endsection
