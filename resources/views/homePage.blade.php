@extends('layouts.customers.app')

@section('content')
@php
$selectedCurrency = Session::get('selectedCurrency', 'MYR');
$usdRate = Session::get('USDRate', 1);
$sgdRate = Session::get('SGDRate', 1);
$bndRate = Session::get('BNDrate', 1);
@endphp
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
    <div class="carousel-inner">

        <div class="carousel-item">
            <video width="100%" height="100%" autoplay muted loop>
                <source src="images/LGMTRAVEL.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="carousel-item active">
            <video width="100%" height="100%" autoplay muted loop>
                <source src="images/adsVid.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>

        </div>
    </div>
</div>
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
                        <input id="date" name="date" class="form-control border-0" min="{{ date('Y-m') }}" type="month">
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
    @if(count($packages) > 0)
<div class="container">
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <div class="titlepage">
                <h2 class="text-center">Packages recommendation</h2>
            </div>
        </div>
    </div>

    <div class="card-wrapper container-sm d-flex flex-wrap justify-content-around">
        @foreach ($packages as $package)
            <a href="{{ route('itinerary', [$package->packageID]) }}" style="text-decoration: none; color: inherit;">
                <div class="card mb-4 package-card" style="width: 20rem; border: none; overflow: hidden; transition: transform 0.3s ease-in-out;">
                    <img src="{{ url('storage/images/'.$package->packageImage) }}" style="height:330px; width:auto"class="card-img-top" alt="{{ $package->packageName }}">
                    <div class="card-body text-center">
                        <h5 class="card-title font-weight-bold">{{ $package->packageName }}</h5>
                        @php
                            $lowestTourPrice = $allTours[$package->packageID]->min('tourPrice');
                        @endphp
                        <h6 class="package-price">
                            @if($selectedCurrency === 'USD')
                                USD {{ number_format($lowestTourPrice * $usdRate, 2) }}
                            @elseif($selectedCurrency === 'SGD')
                                SGD {{ number_format($lowestTourPrice * $sgdRate, 2) }}
                            @elseif($selectedCurrency === 'BND')
                                BND {{ number_format($lowestTourPrice * $bndRate, 2) }}
                            @else
                                RM {{ number_format($lowestTourPrice, 2) }}
                            @endif
                        </h6>
                        <p class="font-weight-normal package-location"><i class="icon-location"></i> {{ $package->destination }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

@endif

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



        <div class="row">
            <div class="col-md-12 " >
                <div class="amazing-box">
                    <h2>Travel without planning ?</h2>
                    <span>You can now generate your own itinerary for FREE !</span>
                    <br>
                    <a href="{{route('searchItinerary')}}">GENERATE NOW</a>
                </div>
            </div>
        </div>

<!-- our blog -->
<div id="blog" class="blog" style="margin-top:0x; margin-bottom:20px">
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


</button>


@endsection