<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <title>{{ $package->packageName }}'s Itinerary</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LGM.png') }}">


<!-- Web Fonts
======================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
======================= -->

</head>
<body>
<!-- Container -->
<div class="container-fluid itinerary-container"> 
  <!-- Header -->
  <header>
    <div class="row align-items-center">
      <div class="col-sm-12 text-center text-sm-left mb-3 mb-sm-0"> 
        <img id="logo" src="{{ asset('images/LGMLH.png') }}" title="LGM" alt="LGM" /> </div>

    </div>
    <hr class="my-4">
  </header>
  <!-- Header End --> 
  
  <!-- Main Content -->
  <main>
    <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6"> 
        <strong class="font-weight-600" style="color:red"><h2><b>{{ $package->packageName }} ({{ $package->destination }})</b></h2></strong>
      </div>
      <div class="col-sm-6 btn-group-sm d-print-none" > 
      <a href="{{ URL::previous() }}" style="float:right" class="btn btn-light border text-black-50 shadow-none">Back</a> 
  <a href="javascript:window.print()" style="float:right" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> 

</div>
    </div>



    @foreach($itineraries as $itinerary)

    <div class="card">
      <div class="card-header" style="background-color:#4dbbbb;padding:10px">
        <!-- sector -->
        <h5 class="m-0" ><b>Day {{ $itinerary->noOfDays }} : {{ $itinerary->remarks }}</b></h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2 border-right"> <strong class="font-weight-600">Hotel Name:</strong>
            <p>{{ $itinerary->hotelName }}</p>
            <strong class="font-weight-600">Meals:</strong>
            <p>{{ $itinerary->meals }}</p>
          </div>
          <div class="col-sm-10">
          <strong class="font-weight-600">Information:</strong>
            <p>{!! nl2br(e($itinerary->information)) !!}</p>
            
          </div>
        </div>
    </div>
    
</div>
    @endforeach
    <hr>
    <div class="row mb-2">
      <div class="col-sm-4">
        <strong class="font-weight-600">Highlight:</strong>
        <p>{!! nl2br(e($package->highlight)) !!}</p>
      </div>
      <div class="col-sm-4"> <strong class="font-weight-600">Remarks:</strong>
        <p>{!! nl2br(e($package->remarks)) !!}</p>
      </div>
    </div>

</div>
  </main>


  <hr>

  
  <footer class="text-center mt-3">
    <p><strong>LGM Tour & Travel Sdn. Bhd.</strong><br>
    U0165, Ground Floor, Jalan Bahasa 87000 Labuan, Malaysia</p>
  </footer>
  
</div>


</body>
</html>