<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Extra details for Live View on GitHub Pages -->

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>LGM Tour & Travel</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/news.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script><!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


</head>
<body>



<!-- navigation -->


<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="#"  >
        <img src="images/LGM.png" width="80px" height="auto" margin-right="50px;" class="d-inline-block align-top" alt="#">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="packagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Packages
                </a>
                <div class="dropdown-menu" aria-labelledby="packagesDropdown">
                    <a class="dropdown-item" href="#">Itinerary</a>
                    <a class="dropdown-item" href="#">Booking</a>
                    <a class="dropdown-item" href="#">Comparison</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="mediaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Media
                </a>
                <div class="dropdown-menu" aria-labelledby="mediaDropdown">
                    <a class="dropdown-item" href="#">News & Blog</a>
                    <a class="dropdown-item" href="#">Gallery</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More
                </a>
                <div class="dropdown-menu" aria-labelledby="moreDropdown">
                    <a class="dropdown-item" href="#">About Us</a>
                    <a class="dropdown-item" href="#">Contact Us</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

@yield('content')

<!-- footer -->
<footer class="text-white text-center text-lg-start" style="background-color: #23242a; padding-top: 20px;">

    <div class="container p-4">
        <div class="row mt-4">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
            <img src="images/LGM.png" alt="Company Logo" class="img-fluid mb-4" style="width:100px; height:auto;">
                <h5 class="text-uppercase mb-4">About Us</h5>
                <p class="text-muted">
                    LGM Tour & Travel Sdn Bhd is a registered travel agency in Labuan. The agency provides travel and tourism-related services on behalf of suppliers such as airlines, car rentals, cruise lines, hotels, and package tours in Sabah.
                </p>
                <div class="mt-4 d-flex justify-content-around">
    <!-- Social media icons -->
    <a type="button" class="btn btn-floating btn-warning btn-md"><i class="fab fa-facebook-f"></i></a>
    <a type="button" class="btn btn-floating btn-warning btn-md"><i class="fab fa-dribbble"></i></a>
    <a type="button" class="btn btn-floating btn-warning btn-md"><i class="fab fa-twitter"></i></a>
    <a type="button" class="btn btn-floating btn-warning btn-md"><i class="fab fa-google-plus-g"></i></a>
</div>

            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4 pb-1">Search Something</h5>
                <!-- Search form -->
<form class="form-inline d-flex justify-content-center md-form form-sm mt-0" style="margin:20px;">
  <i class="fas fa-search" aria-hidden="true"></i>
  <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
    aria-label="Search">
</form>

                <!-- Contact information -->
                <ul class="fa-ul" style="margin-left: 1.65em;">
                    <li class="mb-3">
                        <span class="fa-li"><i class="fas fa-home"></i></span><span class="ms-2">Bandar Labuan, 87000 Labuan, Labuan Federal Territory</span>
                    </li>
                    <li class="mb-3">
                        <span class="fa-li"><i class="fas fa-envelope"></i></span><span class="ms-2">liongsy020601@gmail.com</span>
                    </li>
                    <li class="mb-3">
                        <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2">6087 - 453 880 / 453 881</span>
                    </li>
                    <li class="mb-3">
                        <span class="fa-li"><i class="fas fa-print"></i></span><span class="ms-2">6087- 453 884</span>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                <h5 class="text-uppercase mb-4">Opening Hours</h5>
                <!-- Opening hours table -->
                <table class="table text-center text-white">
                    <tbody class="font-weight-normal">
                        <tr>
                            <td>Mon - Fri:</td>
                            <td>9.30am - 5pm</td>
                        </tr>
                        <tr>
                            <td>Saturday:</td>
                            <td>9.30am - 2pm</td>
                        </tr>
                        <tr>
                            <td>Sunday:</td>
                            <td>Closed</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.2); font-size:12px;">
        © 2023 LGM Tour & Travel Sdn Bhd | All rights reserved
    </div>

    <button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top" style="background-color:blue; color:white; border-radius:100%;">
  <i class="fas fa-arrow-up"></i>
</button>

</footer>

  <script>
     var botmanWidget = {
         introMessage: "Hi ✋! I'm LilyBot from LGM Tour & Travel. <br> Please select the option below:<br><br>1. Booking Assistance.<br>2. Destination Information.<br>3. Feedback and Reviews.<br>4. Chat with agent.",
         title:'LilyBot',
        mainColor:'#1F4E7A',
        background:'#f1f1f1',
        aboutText:'',
       bubbleBackground:'#1F4E7A', //widget
       headerTextColor: '#f1f1f1',
       bubbleAvatarUrl: '{{ asset('images/customer-service.png') }}',
     };
    </script>
</body>
<!-- Remove the container if you want to extend the Footer to full width. -->

  
<!-- End of .container -->
<script>
  // Get the navigation bar element
  const navbar = document.querySelector('.navbar');

  // Function to update the background color of the navigation bar
  function updateNavbarBackground() {
    // Get the current scroll position
    const scrollY = window.scrollY;

    // Set a threshold for when to start changing the background color
    const threshold = 100; // You can adjust this value as needed

    if (scrollY > threshold) {
      // Add a background color to the navigation bar
      navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.9)'; // Change the color and opacity as needed
    } else {
      // Make the navigation bar transparent
      navbar.style.backgroundColor = 'transparent';
    }
  }

  // Listen for scroll events and update the background color
  window.addEventListener('scroll', updateNavbarBackground);

  // Initial call to set the initial background color
  updateNavbarBackground();

  // Get the button
  let mybutton = document.getElementById("btn-back-to-top");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  mybutton.addEventListener("click", backToTop);

  function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }

  
  
</script>


