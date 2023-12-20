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
                src="images/packages.png" preserveAspectRatio="xMidYMid slice" focusable="false">
    <div>


<!-- Search -->
<div class="container" >
<div class="container mt-3">
<form action="{{ route('search') }}" method="GET">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card border shadow mb-4">
                    <div class="card-body"style="border-radius:14px;">
                        <label for="destination" class="form-label">Destination <i class="bi bi-geo-alt"></i></label>
                        <input id="destination" name="destination" class="form-control border-0" type="text" placeholder="Enter your destination">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border shadow mb-4">
                    <div class="card-body"style="border-radius:15px;">
                        <label for="date" class="form-label">Date <i class="bi bi-calendar3" ></i></label>
                        <input id="date" name="date" class="form-control border-0" type="month" min="{{ date('Y-m') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4" style="border-radius:10px;margin-top:13px">
                    <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-block">Explore Now <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-3">
        <form action="{{ route('search') }}" method="get">
                <h3 style="color:#737DBB;">Filter and Sort</h3>

                <div class="form-group">
                    <label for="sort">Sort by</label>
                    <select name="sort" class="form-control">
                        <option value="price_asc">Price (Low to High)</option>
                        <option value="price_desc">Price (High to Low)</option>
                        <!-- Add more sorting options as needed -->
                    </select>
                </div>

            
                <button type="submit" class="btn btn-primary" style="background:#598EC2;">Apply</button>
            </form>
        </div>

        <div class="col-sm-9">
        @if(count($packages) > 0)
        @php
        $today = \Carbon\Carbon::now();
        @endphp

                        
    @foreach ($packages as $package)
    @php
        $expiredTour = 0;
        $totalTours = count($package->tours);
        @endphp
    @foreach($package->tours as $tour)
          @if( $tour->flight->departureDate < $today)
          @php
            $expiredTour+=1;
        @endphp          
        @endif
    @endforeach      
    @if($expiredTour != $totalTours)
        <a href="{{ route('itinerary', [$package->packageID]) }}" style="text-decoration: none; color: inherit;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-10" style="border: 1px solid white; border-radius: 20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <div class="row"  style="height:250px">
                        <div class="col-md-4">
                            <img src="{{ url('storage/images/'.$package->packageImage) }}" style="height:240px;width:200px" alt="{{ $package->packageName }}" class="img-fluid">
                        </div>
                        <div class="col-md-8" style="padding:10px">
                            <h2 style="font-size: 16px; color:blue;"><strong>{{ $package->packageName }}</strong></h2>
                            <p style="font-size: 14px">
                                <i class="icon-location"></i><b>{{ $package->destination }}</b>&nbsp;&nbsp;<i class="bi bi-geo-alt-fill" style="color:orange;"></i>&nbsp;&nbsp;
                            </p>

                            <div>
                                <p style="font-size: 16px;"><i class="bi bi-tag-fill" style="color:red;"></i><strong> Price start from:
                                @if($selectedCurrency === 'USD')
                                USD {{ number_format($minTourPrices[$package->packageID] * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($minTourPrices[$package->packageID] * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($minTourPrices[$package->packageID] * $bndRate, 2) }}
                            @else
                                RM {{ number_format($minTourPrices[$package->packageID], 2) }}
                            @endif    
                                </strong></p>
                            </div>

                            <ul class="add_info" style="color: grey;">
                                <b>Departure Date(s)</b>
                                <div class="date_display"><br>
                                @php
                                $today = \Carbon\Carbon::now();
                                @endphp

                                    @foreach($package->tours as $tour)
                                        @if( $tour->flight->departureDate > $today)
                                        <span class="date">{{ $tour->flight->departureDate }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @endif
    @endforeach
@else
    <div class="col-md-10">
        <p>Oops, sorry! There are no packages found for the given search criteria.</p>
    </div>
@endif

        </div>
    </div>
</div>

@endsection