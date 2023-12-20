<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header {
            background-color: #023e8a;
            color: #fff;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .thank-you {
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
            color: #fff;
        }

        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .details-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: left;
        }

        .details-label {
            font-weight: bold;
            color: #333;
        }

        .details-value {
            color: #555;
        }

        .footer {
            margin-top: 20px;
        }

        .thank-you-message {
            color: #023e8a;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="thank-you">LGM Travel</h1>
        </div>

        <div class="booking-details">
            <div class="details-item">
                <p class="details-label">Booking ID:</p>
                <p class="details-value">{{ $booking->bookingID }}</p>
            </div>
            
            <div class="details-item">
                <p class="details-label">Booking Date:</p>
                <p class="details-value">{{ $booking->bookingDate }}</p>
            </div>

            <div class="details-item">
                <p class="details-label">Tour Code:</p>
                <p class="details-value">{{ $booking->tourCode }}</p>
            </div>

            <div class="details-item">
                <p class="details-label">Booking Status:</p>
                <p class="details-value">{{ $booking->bookingStatus }}</p>
            </div>

            <div class="details-item">
                <p class="details-label">Booking Deposit:</p>
                <p class="details-value"> RM {{ number_format($booking->bookingDeposit, 2, '.', '') }}</p>
            </div>

            <div class="details-item">
                <p class="details-label">Booking Amount:</p>
                <p class="details-value"> RM {{ number_format($booking->bookingAmount, 2, '.', '') }}</p>
            </div>
        </div>

        <div class="footer">
            <p class="thank-you-message">Thank you for booking with us!</p><br>
            <p style="color:red">Please don't hestitate to contact us if you have any question!<br>You will receive an email once your booking has been approved.</p>
        </div>
    </div>
</body>
</html>
