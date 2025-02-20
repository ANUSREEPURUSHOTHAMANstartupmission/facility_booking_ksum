<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .otp {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset("/img/logo.svg") }}" alt="Platform Logo" style="height: 80px;">
        </div>
        <p>Hello!</p>
        <h2 style="text-align: center; color: #444;">Login Verification</h2>
        <p>We received a request to log in to your Facility Booking Platform.</p>
        <p>Please use the following code to verify your login:</p>
        <div class="otp">{{ $otp }}</div>
        <p>This code will expire in <strong>15 minutes</strong>.</p>
        <p>If you did not request this, please ignore this email. For any concerns, feel free to contact our support team.</p>
        <div class="footer">
            <p>Thank you for using our Facility Booking Platform!</p>
            <p>&copy; {{ date('Y') }} Facility Booking Platform</p>
        </div>
    </div>
</body>
</html>
