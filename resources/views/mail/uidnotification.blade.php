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
    <div class="container" style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <div class="header" style="text-align: center;">
            <img src="{{ asset('/img/logo.svg') }}" alt="Platform Logo" style="height: 80px; margin-bottom: 20px;">
        </div>

        <p>Hello,</p>

        <h2 style="text-align: center; color: #444;">Unique ID Verification</h2>

        <p>We received a request to verify your **Unique ID** for your account on the Facility Booking Platform.</p>

        <p><strong>Requested by:</strong> {{ $email }}</p>

        <p>Please use the following OTP to verify your Unique ID:</p>

        <div style="text-align: center; font-size: 24px; font-weight: bold; color: #444; background: #f3f3f3; padding: 10px; border-radius: 5px; display: inline-block; margin: 10px 0;">
            {{ $otp }}
        </div>

        <p>This OTP will expire in <strong>15 minutes</strong>.</p>

        <p>If you did not request this verification, please ignore this email. If you have any concerns, please contact our support team.</p>

        <div class="footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #666;">
            <p>Thank you for using our Facility Booking!</p>
            <p>&copy; {{ date('Y') }} Facility Booking</p>
        </div>
    </div>

</body>
</html>
