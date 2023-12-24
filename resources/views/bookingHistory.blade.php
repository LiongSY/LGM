@extends('layouts.customers.app')

@section('content')
@php
$selectedCurrency = Session::get('selectedCurrency', 'MYR');
$usdRate = Session::get('USDRate', 1);
$sgdRate = Session::get('SGDRate', 1);
$bndRate = Session::get('BNDrate', 1);
@endphp
<div style="margin-top:9%;margin-right:30px; margin-left:30px">
<div class="container">
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
    <h2 class="text-charcoal hidden-sm-down">Your Booking History</h2>
    <div class="booking-container" style="margin-top:20px; margin-bottom:20px">
    @foreach($bookings as $booking)
        <div class="booking-card">
            <div class="booking-header">
                <h5 class="booking-title">Booking #{{$booking->bookingID}}</h5>
                <span class="booking-date">{{ $booking->bookingDate}}</span>
            </div>
            <div class="booking-details">
                <div class="booking-info">
                    <p><strong>Tour Code:</strong> {{ $booking->tourCode}}</p>
                    <p><strong>Status:</strong> {{ $booking->bookingStatus}}</p>
                </div>
                <div class="booking-amounts">
                    <p><strong>Total Amount :</strong> @if($selectedCurrency === 'USD')
                                USD {{ number_format($booking->bookingAmount * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($booking->bookingAmount * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($booking->bookingAmount * $bndRate, 2) }}
                            @else
                                RM {{ number_format($booking->bookingAmount, 2) }}
                            @endif</p>
                    <p><strong>Deposit:</strong> @if($selectedCurrency === 'USD')
                                USD {{ number_format($booking->bookingDeposit * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($booking->bookingDeposit * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($booking->bookingDeposit * $bndRate, 2) }}
                            @else
                                RM {{ number_format($booking->bookingDeposit, 2) }}
                            @endif</p>
                </div>
            </div>
            <form action="{{ route('booking.customerDestroy', [$booking->bookingID]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                        </form>
        </div>
    @endforeach
</div>

</div>
</div>

@endsection
