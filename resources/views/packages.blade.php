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
                    <!-- <h3 class="text-center">Location <i class="bi bi-geo-alt"></i></h3> -->
                    <input class="form-control" type="text" placeholder="Enter your destination">
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="border: none;">
                    <!-- <h3 class="text-center">Date <i class="bi bi-caret-down-fill"></i></h3> -->
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

<div class="container-fluid" style="margin: 40px;">
    <div class="row content">
        <div class="col-sm-3 sidenav" style="height: 100%; background-color: #f1f1f1;">
            <h2>Tour Category</h2>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="cruiseCheckbox">
                <label class="form-check-label" for="cruiseCheckbox">Cruise</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="groupTourCheckbox">
                <label class="form-check-label" for="groupTourCheckbox">Group Tour</label>
            </div>

            <h2>Price</h2>
            <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
        </div>
    </div>
</div>
@endsection
