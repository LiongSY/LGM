@extends('layouts.customers.app')

@section('content')

<!-- Search -->
<div class="container"  style="margin-top:9%">
<div class="container mt-1" style="width:50%">
<form action="" method="GET" class="mb-3">
           <div class="input-group">
            <input type="text" class="form-control" placeholder="Search packages" name="search">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
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
    @foreach ($packages as $package)
    <div class="col-sm-9" >
    <a href="{{ route('itinerary', [$package->packageID]) }}">
        <div style="border:1px solid white; margin:5px; border-radius:20px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="row">
            <div class="col-md-4">
                <div class="img_list" style="border-radius:20px;">
                <img src="{{ $package->packageImage }}" alt="#" class="zoomable-image">
                </div>
            </div>
            <div class="col-md-8" style="padding-top:10px; padding-right:20px">
                <h2 style="font-size:14px;"><strong>{{ $package->packageName }}</strong></h2>
                <p style=" font-size:14px">
                <i class="icon-location"></i>{{$package->destination}}&nbsp;&nbsp;<i class="bi bi-geo-alt-fill"></i>
                <!-- <a href="https://s3-ap-southeast-1.amazonaws.com/storage.iceb2b.my/itinerary/2054/file/Spectrum_of_the_Seas_6pp_Brochure_May_2023__FA.pdf" target="_blank">package download</a> -->
                &nbsp;&nbsp;<img src="/" width="22px"> </p>
                
                <div>
                            <p style="font-size: 18px;"><i class="bi bi-tag-fill"></i><strong>Price: RM 1,888</strong></p>
                        </div>


                <ul class="add_info" style="color:grey;">
                    <b>Departure Date(s)</b>
                    <div class="date_display"><br>
                        <span class="date">16Nov2023</span>
                        <span class="date">30Nov2023</span>
                    </div>	
                </ul>
            </div>
        </div>
        </a>
    </div>
    @endforeach
</div>
</div>
</div>
</div>
</div>
</div>
</div>


@endsection
