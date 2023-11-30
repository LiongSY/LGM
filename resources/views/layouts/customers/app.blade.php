<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Extra details for Live View on GitHub Pages -->

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>LGM Tour & Travel</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/style.css">
<!-- Add this in the head section of your HTML -->
 

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!--   Core JS Files   -->
    <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
   
</head>
<style>
    @keyframes slideIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .btn-primary {
        background-color: #1d3557;
        color: #fff;
        border: 1px solid #1d3557;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        color: #fff;
        transform: scale(1.05);
    }

    .custom-animated-heading {
        animation: slideIn 0.5s ease-in-out;
        color: #6c584c;
        display: inline-block;
    }

    .custom-animated-paragraph {
        animation: fadeIn 0.5s ease-in-out;
        color: #22333b;
        display: inline;
    }
.animated-card {
    border: 1px solid grey;
    border-radius: 20px;
    padding: 15px;
    margin-bottom: 30px;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.animated-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
.booking-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-around;
    max-width: 1200px; /* Set a maximum width for the container */
    margin: 0 auto; /* Center the container */
}

.booking-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
    width: calc(33.33% - 20px); /* 33.33% width with 20px gap between cards */
    margin-bottom: 20px; /* Add some bottom margin for spacing */
}

.booking-card:hover {
    transform: scale(1.05);
}

.booking-header {
    background-color: #203d94;
    color: #fff;
    padding: 10px;
}

.booking-title {
    margin: 0;
}

.booking-date {
    font-size: 0.8rem;
}

.booking-details {
    padding: 15px;
}

.booking-info,
.booking-amounts {
    margin-bottom: 10px;
}

.booking-info p,
.booking-amounts p {
    margin: 0;
}
    </style>
<body>



<nav class="navbar navbar-expand-lg custom-navbar-bg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/LGM.png') }}" width="100" height="100" class="d-inline-block align-top" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('homePage') }}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('search') }}">Packages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('aboutUs') }}">About Us</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="currencyDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Currency
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="currencyDropdown">
            <form action="{{ route('currency.update')}}" method="post">
    @csrf
    <button type="submit" class="dropdown-item" name="selectedCurrency" value="MYR"><i class="flag flag-my"></i>MYR</button>
    <button type="submit" class="dropdown-item" name="selectedCurrency" value="SGD"><i class="flag flag-sg"></i>SGD</button>
    <button type="submit" class="dropdown-item" name="selectedCurrency" value="USD"><i class="flag flag-us"></i>USD</button>
    <button type="submit" class="dropdown-item" name="selectedCurrency" value="BND"><i class="flag flag-bn"></i>BND</button>
</form>
            </div>
        </li>
        @if(auth()->check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('customerProfile') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bookingHistory') }}">Booking</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @endif
    </ul>
</div>
    </div>
</nav>




@yield('content')

<!-- footer -->
<footer class="text-white text-center text-lg-start" style="background-color: #23242a; padding-top: 20px;">

    <div class="container p-4">
        <div class="row mt-4">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
            <img src="{{ asset('images/LGM.png') }}" alt="Company Logo" class="img-fluid mb-4" style="width:100px; height:auto;">
                
                <div class="mt-4 d-flex justify-content-around">
    <!-- Social media icons -->
    <a href="https://www.facebook.com/LGMTravel" class="btn btn-floating btn-warning btn-md"><i class="fab fa-facebook-f"></i></a>
    <a href="mailto:lgmtravel88@gmail.com" class="btn btn-floating btn-warning btn-md"><i class="far fa-envelope"></i></a>
    <a href="https://wa.me/60178186906" class="btn btn-floating btn-warning btn-md"><i class="fab fa-whatsapp"></i></a>
    <a href="https://www.google.com/search?q=lgm+tour+%26+travel+sdn+bhd&source=lmns&bih=707&biw=1536&rlz=1C1CHBF_enMY1013MY1013&hl=en&sa=X&ved=2ahUKEwjl8byUm9mCAxWaa2wGHYqtDeQQ_AUoAHoECAEQAA" target="_blank" class="btn btn-floating btn-warning btn-md"><i class="fab fa-google"></i></a>
</div>

            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
 
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



</footer>

  <script>
     var botmanWidget = {
         introMessage: "Hi ✋! I'm Lily from LGM Tour & Travel. <br> Please select the option below:<br><br>1. Booking Assistance.<br>2. Chat with agent.",
         title:'LGM Tour & Travel',
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

  
</script>


