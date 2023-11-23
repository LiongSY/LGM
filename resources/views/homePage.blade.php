@extends('layouts.customers.app')

@section('content')
@php
    $selectedCurrency = Session::get('selectedCurrency', 'MYR');
    $usdRate = Session::get('USDRate', 1);
    $sgdRate = Session::get('SGDRate', 1);
    $bndRate = Session::get('BNDrate', 1);
@endphp

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
    <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button> -->
</div>


<!-- Search -->
<div class="container mt-3">
    <form>
        <div class="row justify-content-center" style="margin-top:30px">
            <div class="col-md-3">
                <div class="card" style="border:none;">
                    <!-- <h3 class="text-center">Location <i class="bi bi-geo-alt"></i></h3> -->
                    <input class="form-control" type="text" placeholder="Enter your destination">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border:none;">
                    <!-- <h3 class="text-center">Date <i class="bi bi-caret-down-fill"></i></h3> -->
                    <input class="form-control" type="date">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border:none; border-radius:10px;">
                    <button class="btn btn-primary btn-block">Explore Now</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="container">
<div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <div class="titlepage">
                <h2>Trending Packages</h2>
            </div>
        </div>
    </div>

<div class="card-wrapper container-sm d-flex flex-wrap justify-content-around">
@foreach ($packages as $package)
    <a href="{{ route('itinerary', [$package->packageID]) }}" style="text-decoration: none; color: inherit;">
        <div class="card mb-4"
            style="width: 20rem; border:none; overflow:hidden;  transition: transform 0.3s ease-in-out;">
            <img src="images/tour1.jpg" class="card-img-top" >
            <div class="card-body">
                <h5 class="card-title font-weight-bold">{{ $package->packageName }}</h5>
                @php
        $lowestTourPrice = $allTours[$package->packageID]->min('tourPrice');
    @endphp
    <h6>
    @if($selectedCurrency === 'USD')
        USD {{ number_format($lowestTourPrice * $usdRate, 2) }}
    @elseif($selectedCurrency === 'SGD')
        SGD {{ number_format($lowestTourPrice * $sgdRate, 2) }}
    @elseif($selectedCurrency === 'BND')
        BND {{ number_format($lowestTourPrice * $bndRate, 2) }}
    @else
        RM {{ number_format($lowestTourPrice, 2) }}
    @endif
</h6>                <i class="icon-location"></i><p class="font-weight-normal">{{ $package->destination }}</p>
            </div>
        </div>
    </a>
    @endforeach

    
</div>
</div>





<!-- service -->

<div class="container">
<div class="row" style="margin-top:30px">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Services</h2>
                    </div>
                </div>
            </div>   
    <div class="row">
        <div class="col-lg-4 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-eercast"></i>
                    </div>
                    <h4>Accommodation</h4>
                    <p class="xs-font-size13 xs-line-height-22">Strategic location, safe environment and easy
                        accessibility are the features that we look for our customers' hotel bookings.</p>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-snowflake-o"></i>
                    </div>
                    <h4>Travel Insurance</h4>
                    <p class="xs-font-size13 xs-line-height-22">We care about you, so we got you covered.
                        The travel insurance covers all of the item loss during the journey as well as flight issues.
                    </p>
                </a>
            </div>
        </div>
        <div class="services-block-three col-lg-4 col-md-6 margin-30px-bottom xs-margin-20px-bottom">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-braille"></i>
                    </div>
                    <h4>Sight Seeing Planning</h4>
                    <p class="xs-font-size13 xs-line-height-22">Tell us the tourist spots taht you wished to visit and
                        we will plan the itinerary for you. We are assuring you a smooth journey with no time is wasted.
                    </p>
                </a>
            </div>
        </div>
        <div class="services-block-three col-lg-4 col-md-6 sm-margin-30px-bottom xs-margin-20px-bottom">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-diamond"></i>
                    </div>
                    <h4>Hotels & Resorts</h4>
                    <p class="xs-font-size13 xs-line-height-22">Exhaustive technology of implementing multi purpose
                        projects is putting your project successful.</p>
                </a>
            </div>
        </div>
        <div class="services-block-three col-lg-4 col-md-6 xs-margin-20px-bottom">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-object-ungroup"></i>
                    </div>
                    <h4>Consulting</h4>
                    <p class="xs-font-size13 xs-line-height-22">Consulting services include a large number of aspects
                        which are related, more or less directly, with travel: information of interest for the traveller
                    </p>
                </a>
            </div>
        </div>
        <div class="services-block-three col-lg-4 col-md-6">
            <div class="services-block-three">
                <a href="#">
                    <div class="padding-15px-bottom">
                        <i class="fa fa-paper-plane-o"></i>
                    </div>
                    <h4>Clean Modern Code</h4>
                    <p class="xs-font-size13 xs-line-height-22">Exhaustive technology of implementing multi purpose
                        projects is putting your project successful.</p>
                </a>
            </div>
        </div>
        <!-- end -->
    </div>
</div>



<!-- amazing -->
<div class="amazing">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="amazing-box">
                    <h2>Make A Amazing Memory</h2>
                    <span>Escape to your dream destination today! Book your next adventure with us and create
                        unforgettable memories. Don't wait, your perfect getaway is just a click away. Secure your
                        journey now</span>
                    <a href="#">Book Now</a>
                    <a href="#">Get More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- our blog -->
<div id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>News and Events</h2>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event1.jpg" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2022-10-16
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">Allianz Event Promo买保险</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event2.png" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2022-10-20
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">SOP戴口罩</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event3.jpg" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2023-03-17
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">Lucky Draw幸运抽奖活动2023</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event4.jpg" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2023-04-05
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">黄金旅程(Golden Destinations)CompanyTrip</h3>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event5.jpg" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2023-06-17
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">Member Gathering</h3>
                        </a>

                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="event_container">
                    <a href="#">
                        <img src="images/event6.jpg" class="img-responsive" alt="#">
                        <div class="short_info event">
                            2020-08-25
                        </div>
                    </a>
                    <div class="event_title">
                        <a href="#">
                            <h3 style="font-size:15px;">MATTAFAIR 2023</h3>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="subscribe" style="margin:70px;">
    <section class="bg-img text-center" style="padding:4%; background:#7e8890;">
        <div class="container">
            <h2 style="color:#e6e6e6;">
                <strong>Subscribe</strong>
            </h2>
            <h6 class="font-alt" style="color:#e6e6e6;">Get weekly top new jobs delivered to your inbox</h6>
            <br><br>
            <form class="form-subscribe" action="#">
                <div class="input-group">
                    <input type="text" class="form-control input-lg" placeholder="Your email address">

                    <span class="input-group-btn">
                        <button class="btn btn-success btn-lg" type="submit">Subscribe</button>
                    </span>
                </div>
            </form>
        </div>
    </section>
</div>

<<<<<<< HEAD

</button>


@endsection
=======
<!-- Subscribe -->
<section class="bg-img text-center" style="padding: 4%; height:30%; background: url(images/newHeader.jpg);">
    <div class="container">
        <h2 style="color: #e6e6e6; margin-bottom:40px;">
            <strong>Subscribe</strong>
        </h2>
        <div class="modal-body text-center" style="padding:20px; margin-top:-40px;">
    <h4 style="margin-bottom:10px; color:blue;">Subscribe to our newsletter</h4>
    <p style="margin:10px; color:white;">Subscribe to keep up with fresh news and exciting updates.</p>
    <div class="input-group">
        <input type="email" class="form-control" placeholder="Enter your email address" name="email">
        <div class="input-group-append">
            <input type="submit" class="btn" value="Subscribe">
        </div>
    </div>
</div>
    </div>      
</section>

<br><br>
 
        @endsection

        
       
>>>>>>> d837a4d7a81e8355d12ba8764455726ee8f9089e
