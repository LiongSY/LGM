@extends('layouts.customers.app')

@section('content')

<!-- Search -->
<div class="container" style="margin-top: 9%">
    <div class="container mt-1" style="width: 50%">
        <form action="{{ route('displayPackages') }}" method="GET">
            <div class="form-group">
                <label for="search">Search Packages:</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Enter keywords">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3">
            <form action="" method="get">
        <h3>Filter and Sort</h3>

        <!-- Filter by Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <select name="location" class="form-control">
                <option value="">All</option>
                <option value="China">China</option>
                <!-- Add more location options as needed -->
            </select>
        </div>

        <!-- Sort by Price -->
        <div class="form-group">
            <label for="sort">Sort by</label>
            <select name="sort" class="form-control">
                <option value="price_asc">Price (Low to High)</option>
                <option value="price_desc">Price (High to Low)</option>
                <!-- Add more sorting options as needed -->
            </select>
        </div>

        <!-- Filter by Date -->
        <div class="form-group">
            <label for="date">Filter by Date</label>
            <select name="date" class="form-control">
                <option value="">All Dates</option>
                <option value="2023-11">November 2023</option>
                <option value="2023-12">December 2023</option>
                <!-- Add more date options as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Apply</button>
    </form>
    </div>

    @if(count($packages) > 0)
    @foreach ($packages as $package)
    <div class="col-sm-9" >
    <a href="{{ route('itinerary', [$package->packageID]) }}">
    <div class="col-md-10" style="padding-top:10px; padding-right:10px border:1px solid white; margin:5px; border-radius:20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <h2 style="font-size:14px;"><strong>{{ $package->packageName }}</strong></h2>
    <p style="font-size:14px">
        <i class="icon-location"></i>{{ $package->destination }}&nbsp;&nbsp;<i class="bi bi-geo-alt-fill"></i>
        &nbsp;&nbsp;<img src="/" width="22px">
    </p>

    @php
        $lowestTourPrice = $allTours[$package->packageID]->min('tourPrice');
    @endphp

    <div>
        <p style="font-size: 18px;"><i class="bi bi-tag-fill"></i><strong>Price start from : RM {{ $lowestTourPrice }}</strong></p>
    </div>

    <ul class="add_info" style="color: grey;">
        <b>Departure Date(s)</b>
        <div class="date_display"><br>
            @foreach($allTours[$package->packageID] as $tour)
                    <span class="date">{{ $departureDates[$tour->flightID] }}</span>
            @endforeach
        </div>
    </ul>
</div>

        </a>
    </div>
    @endforeach
    @else
    <div class="col-sm-9">
                    <p>Opps sorry, there are no packages found for the given search criteria.</p>
                </div>
                @endif
</div>
</div>
</div>
</div>
</div>

@endsection
