
@extends('layouts.customers.app')

@section('content')

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/autumn.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/winter.jpeg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/summer.jpeg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<!-- Search -->
<div class="container mt-3" >
    <form>
        <div class="row justify-content-center" style="border:1px solid black; border-radius:20px;">
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

    <div id="carouselExampleControls" class="carousel carousel-dark slide mb-4"> <!-- Added "mb-4" class for margin at the bottom -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h4 class="text-center mt-5"><b>Trending Packages<b></h4> <!-- Increased the top margin for additional space -->
                <div class="card-wrapper container-sm d-flex justify-content-around">
                    <div class="card" style="width: 20rem; border:none;">
                        <img src="images/tour1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Korea Trip 7D6N</h5>
                            <p class="card-text">RM3855.00 ++</p>
                            <p class="font-weight-normal">Korea: From stunning landscapes to rich culture, Korea offers a world of exploration waiting for you to discover.</p>
                            <a href="#" class="btn btn-primary mt-3">Explore Now</a>
                        </div>
                    </div>
                    <div class="card" style="width: 20rem; border:none;">
                        <img src="images/tour2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Japan Trip 6D5N</h5>
                            <p class="card-text">RM4788.00 ++</p>
                            <p class="font-weight-normal">Japan: Go japan go travel good good good</p>
                            <a href="#" class="btn btn-primary mt-3">Explore Now</a>
                        </div>
                    </div>
                    <div class="card" style="width: 20rem; border:none;">
                        <img src="images/tour3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">Europe Trip 5D4N</h5>
                            <p class="card-text">RM8388 ++</p>
                            <p class="font-weight-normal">Europe: A tapestry of history, art, and culture that's yours to explore. Journey through picturesque landscapes and iconic cities on your European adventure.</p>
                            <a href="#" class="btn btn-primary mt-3">Explore Now</a>
                        </div>
                    </div>

                    
                </div>
            </div>
            </div>
            
           
<div class="container-services text-center">
    <div class="row justify-content-center align-items-start mb-5">
        <div class="col-lg-6 custom-margin">
            <h3 class="section-title mb-3">Our Services</h3>
            <p>Unlocking Unforgettable Journeys: Our Services, Your Adventures.</p>
        </div>
    </div>
</div>

<div class="container">
    <section>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-hammer"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-brush"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-wrench"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-truck-pickup"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="icon-wrapper">
                        <i class="fas fa-plug"></i>
                    </div>
                    <h3 class="card-title">Service Heading</h3>
                    <p class="service">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam consequatur necessitatibus eaque.
                    </p>
                </div>
            </div>
        </div>
    </section>
</div>



            <!-- Add more carousel items here -->
      
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

@endsection


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>