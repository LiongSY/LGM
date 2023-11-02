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

                
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
            

<div class="container-services text-center">
    <div class="row justify-content-center align-items-start mb-5">
        <div class="col-lg-6 custom-margin">
            <h3 class="section-title mb-3">Our Partnership</h3>
        </div>
    </div>
</div>
<div class="carousel-container">
        <div class="carousel">
            <img src="partner1.jpg" alt="Image 1">
            <img src="partner2.jpg" alt="Image 2">
            <img src="partner3.jpg" alt="Image 3">
            <img src="partner4.png" alt="Image 4">
            <img src="partner5.png" alt="Image 5">
            <img src="partner6.jpg" alt="Image 6">
            <img src="partner7.png" alt="Image 7">
            <img src="partner8.png" alt="Image 8">
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


<!-- Amazing -->
<div class="amazing">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="amazing-box">
               <h2>Make A Amazing Memory</h2>
               <span>Escape to your dream destination today! Book your next adventure with us and create unforgettable memories. Don't wait, your perfect getaway is just a click away. Secure your journey now</span>
               <a href="#">Book Now</a>
               <a href="#">Get More</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end Amazing -->





  <!-- our blog -->
  <div id="blog" class="blog">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>News and Events</h2>
                     <span>Bits and pieces of the world!</span> 
                  </div>
               </div>
            </div>
            <div class="row">



<div class="col-md-4 col-sm-6">
    <div class="event_container">
        <div>
            <a href="#">
                <img src="images/event1.jpg" class="img-responsive" alt="#">
                <div class="short_info event">
                2022-10-16								
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                <h3 style="font-size:15px;">Allianz Event Promo买保险</h3></a>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6">
    <div class="event_container">
        <div>
            <a href="#">
                <img src="images/event2.png" class="img-responsive" alt="#">
                <div class="short_info event">
                2022-10-20								
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                    <h3 style="font-size:15px;">SOP戴口罩</h3></a>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6">
    <div class="event_container">
        <div>
            <a href="#">
                <img src="images/event3.jpg" class="img-responsive" alt="#">          
                <div class="short_info event">
                2023-03-17								
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                    <h3 style="font-size:15px;">Lucky Draw幸运抽奖活动2023</h3></a>
        </div>
    </div>
</div>

<div class="col-md-4 col-sm-6">
    <div class="event_container">
    
        <div>
            <a href="#">
                <img src="images/event4.jpg" class="img-responsive" alt="#">          
                <div class="short_info event">
                2023-04-05								
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                    <h3 style="font-size:15px;">黄金旅程(Golden Destinations)CompanyTrip</h3></a>
        </div>
    </div>
</div>


<div class="col-md-4 col-sm-6">
    <div class="event_container">
        <div>
            <a href="#">
                <img src="images/event5.jpg" class="img-responsive" alt="#">
                <div class="short_info event">
                2023-06-17								
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                    <h3 style="font-size:15px;">Member Gathering</h3></a>
        
        </div>
    </div>
</div>


<div class="col-md-4 col-sm-6">
    <div class="event_container">
        <div>
            <a href="#">
                <img src="images/event6.jpg" class="img-responsive" alt="#">
                <div class="short_info event">
                2020-08-25						
            </div>
            </a>
        </div>
        <div class="event_title">
                <a href="#">	
                    <h3 style="font-size:15px;">MATTAFAIR 2023</h3></a>
            
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
                <button class="btn btn-success btn-lg" type="submit" >Subscribe</button>
              </span>
            </div>
          </form>
        </div>
      </section>
</div>
 
<footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                        <div class="logo-widget footer-widget">
                            <figure class="logo-box"><a href="#"><img src="images/LGM.png" alt="#"></a></figure>
                            <div class="text">
                                <p>Embark on a journey of a lifetime and immerse yourself in the beauty of our world. Let's explore new places, experience different cultures, and create cherished memories together.
                                Join us as we travel, not just to see the world, but to make memories that will stay with us forever.</p>
                            </div>
                            <ul class="footer-social">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
                                <li><a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 offset-lg-2 footer-column">
                        <div class="service-widget footer-widget">
                            <div class="footer-title">Services</div>
                            <ul class="list">
                                <li><a href="#">Packages</a></li>
                                <li><a href="#">Ticket</a></li>
                                <li><a href="#">Plan</a></li>
                                <li><a href="#">Seat</a></li>
                                <li><a href="#">Sit</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 footer-widget">
                        <div class="contact-widget footer-widget">
                            <div class="footer-title">Contacts</div>
                            <div class="text">
                                <p>Liong Soon Yik</p>
                                <p>012-8916906</p>
                                <p>liongsy0206@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <div class="copyright"><a href="#">Anup</a> &copy; 2019 All Right Reserved</div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 column">
                    <ul class="footer-nav">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
