<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
        }

        .approved {
            color: #28a745;
        }

        .completed {
            color: #007bff;
        }

        .rejected {
            color: #dc3545;
        }
        .pending{
            color:orange;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Booking Status Update</h2>

        @if($booking->bookingStatus == 'Booking Approved')
            <p class="approved">Your booking ({{$booking->bookingID}}) has been approved. Our staff will contact you in a short while.</p>
        @elseif($booking->bookingStatus == 'Completed')
            <p class="completed">Your booking ({{$booking->bookingID}}) have been paid. <br>Thank you for joining the tour! Enjoy the trip!</p>
        @elseif($booking->bookingStatus == 'Pending Approval')
            <p class="pending">Your booking ({{$booking->bookingID}}) is pending for approval. <br>Thank you for joining the tour!</p>
        @elseif($booking->bookingStatus == 'Room Pending')
            <p class="pending">Your booking ({{$booking->bookingID}}) has been reviewed.<br>Our staff is arranging the room.</p>
        @elseif($booking->bookingStatus == 'Booking Rejected')
            <p class="rejected">We are sorry! Your booking ({{$booking->bookingID}}) has been rejected.<br><br>Reason: {{ $customMessage }}</p>
        @endif

        <p>If you have any questions, feel free to contact us. Thank you for choosing our services.</p>
    </div>
</body>
</html>
