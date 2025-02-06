<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <title>{{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}'s report</title>
    <link rel="icon" type="image/png" href="{{ asset('images/LGM.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <script src="https://cdn.tiny.cloud/1/n9sum0xwk0am6ysm62tfvipkk1thz3xc7udxi3d9w49culco/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>

    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">

        <div class="row">
        <img id="logo" src="{{ asset('images/LGMLH.png') }}" title="LGM" alt="LGM" /> </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h5 class="card-title">Reports</h5>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive" style="overflow:hidden">
                    <div class="col-sm-12 btn-group-sm d-print-none" > 
                    <form method="get" action="{{ route('booking-report') }}">
        <label for="selectedMonth">Select Month:</label>
        <input type="month" id="selectedMonth" name="selectedMonth" value="{{ $selectedMonth }}" required>
        <button type="submit">Search</button>
    </form>

      <a href="{{route('dashboard')}}" style="float:right" class="btn btn-light border text-black-50 shadow-none">Back</a> 
  <a href="javascript:window.print()" style="float:right" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> 

</div>
                    

    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Booking Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->bookingID }}</td>
                    <td>{{ $booking->bookingDate }}</td>
                    <td>RM {{ number_format($booking->bookingAmount, 2, '.', '') }}</td>
                </tr>
            @endforeach
            <tr>
                <td><b>Total Amount for {{ \Carbon\Carbon::parse($selectedMonth)->format('F Y') }}:</b></td>
                <td></td>
                <td><b>RM {{ number_format($totalAmount, 2, '.', '') }}</b></td>
            <tr>
        </tbody>
    </table>
    <hr>
    <h5 class="card-title">Top 3 tours</h5>
    <table class="table">
        <tbody>
        @foreach($top3Tours as $tour)
            <tr>
            <td>{{ $tour->tourCode }} - {{ $tour->tourLanguages }} - Bookings: {{ $tour->bookings_count }}</td>
            <tr>
            @endforeach
        </tbody>
    </table>

<div class="graph-container">
    <canvas id="topToursChart" width="400" height="200"></canvas>
</div>
    </div>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
</body>
    </html>

    <script>
            document.addEventListener('DOMContentLoaded', function () {
        var topToursData = @json($top3Tours);

        var tourLabels = topToursData.map(function(tour) {
            return tour.tourCode;
        });

        var tourBookings = topToursData.map(function(tour) {
            return tour.bookings_count;
        });

        var ctx = document.getElementById('topToursChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tourLabels,
                datasets: [{
                    label: 'Bookings Count',
                    data: tourBookings,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    });

    </script>


