@extends('layouts.customers.app')

@section('content')
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item">
            <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500"
                src="images/winter.jpeg" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
        <div class="carousel-item">
            <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500"
                src="images/summer.jpeg" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
        <div class="carousel-item active">
            <img class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800" height="500"
                src="images/autumn.jpeg" preserveAspectRatio="xMidYMid slice" focusable="false">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<!-- Search -->
<div class="container mt-3">
    <form>
        <div class="row justify-content-center" style="margin-top: 30px">
            <div class="col-md-3">
                <div class="card" style="border: none;">
                    <input class="form-control" type="text" placeholder="Enter your destination">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: none;">
                    <input class="form-control" type="date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: none; border-radius: 10px;">
                    <button class="btn btn-primary btn-block">Explore Now</button>
                </div>
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

    <div class="col-sm-9">
        <div style="border:2px solid black; margin:5px">
        <div class="row">
            <div class="col-md-4">
                <div class="img_list">
                    <img src="images/event4.jpg" alt="#" class="zoomable-image">
                </div>
            </div>
            <div class="col-md-8">
                <h2 style="font-size:14px;"><strong>[GRAZY MEGA DEALS 3.0 - INTERIOR TWIN] 5D4N SINGAPORE/PENANG/PHUKET/SINGAPORE (SPECTRUM OF THE SEAS)</strong></h2>
                <p style=" font-size:14px">
                <i class="icon-location">
                </i>ASIA, CRUISE&nbsp;&nbsp;<i class="bi bi-geo-alt-fill"></i><a href="https://s3-ap-southeast-1.amazonaws.com/storage.iceb2b.my/itinerary/2054/file/Spectrum_of_the_Seas_6pp_Brochure_May_2023__FA.pdf" target="_blank">package download</a>&nbsp;&nbsp;<img src="/" width="22px"> </p>
                
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
    </div>
    
</div>
</div>
</div>
</div>
</div>
</div>



@endsection
