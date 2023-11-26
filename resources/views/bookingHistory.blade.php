@extends('layouts.customers.app')

@section('content')

<div class="container mt-3 mt-md-5">
    <h2 class="text-charcoal hidden-sm-down">Your Booking History</h2>
    <div class="row">
        <div class="col-12">
            <div class="list-group mb-5">
                <div class="list-group-item p-3 bg-snow" style="position: relative;">
                    <div class="row w-100 no-gutters">
                        <div class="col-6 col-md">
                            <h6 class="text-charcoal mb-0 w-100">Package Name</h6>
                            <a href="" class="text-pebble mb-0 w-100 mb-2 mb-md-0">Here</a>
                        </div>
                        <div class="col-6 col-md">
                            <h6 class="text-charcoal mb-0 w-100">Destination</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">Aug 5th, 2017</p>  
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Tour Price</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">$19.54</p> 
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Booking Amount</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">Late M. Night</p> 
                        </div>
                        <div class="col-6 col-md"> 
                            <h6 class="text-charcoal mb-0 w-100">Booking Deposit</h6>
                            <p class="text-pebble mb-0 w-100 mb-2 mb-md-0">Late M. Night</p> 
                        </div>
                    </div>
                </div>

                <div class="list-group-item p-3 bg-white">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-9 pr-0 pr-md-3">
                            <div class="alert p-2 alert-success w-100 mb-0">
                            @foreach($bookings as $booking)
                                <h6 class="text-green mb-0"><b>Booking Date</b></h6>
                                <p class="text-green hidden-sm-down mb-0">{{ $booking->bookingDate}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
