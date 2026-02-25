<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Security Token</title>
    <style>
        /* Inline CSS for maximum email client compatibility */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #4f46e5;
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 40px;
            text-align: center;
            color: #374151;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .token-wrapper {
            background-color: #f9fafb;
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
            display: inline-block;
        }
        .token {
            font-family: 'Courier New', Courier, monospace;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 5px;
            color: #111827;
        }
        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            background-color: #f9fafb;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Security Verification</h1>
        </div>

        <!-- Main Content Section -->
        <div class="content">
            <p>Hello{{ isset($user) ? ' ' . $user->name : '' }},</p>
            <p>You requested a security token to access your account. Please use the code below to complete your request.</p>
            
            <div class="token-wrapper">
                <span class="token">{{ $token }}</span>
            </div>

            <p>This token is valid for the next 15 minutes. If you did not request this, please ignore this email or contact support.</p>
            
            @if(isset($actionUrl))
                <a href="{{ $actionUrl }}" class="button">Verify Now</a>
            @endif
        </div>

        <!-- Footer Section -->
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.<br>
            If you have any questions, please contact our support team.
        </div>
    </div>
</body>
</html>