<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to StayEase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .email-header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .email-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .email-body {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .message {
            font-size: 14px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 30px;
        }

        .success-badge {
            display: inline-block;
            background-color: #4caf50;
            color: white;
            padding: 10px 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
            font-size: 13px;
            color: #555;
        }

        .info-box strong {
            color: #2c3e50;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin-top: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .email-footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #999;
        }

        .footer-divider {
            margin: 15px 0;
            height: 1px;
            background-color: #eee;
        }

        .social-links {
            margin: 15px 0;
            font-size: 13px;
        }

        .social-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
        }

        .copyright {
            font-size: 11px;
            color: #bbb;
            margin-top: 15px;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }

            .email-header {
                padding: 30px 20px;
            }

            .email-header h1 {
                font-size: 24px;
            }

            .email-body {
                padding: 30px 20px;
            }

            .greeting {
                font-size: 16px;
            }

            .message {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>✨ Welcome to StayEase</h1>
            <p>Your Journey to Perfect Stays Begins Here</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">Hello {{ $userName }},</div>

            <div class="success-badge">✓ Account Created Successfully</div>

            <div class="message">
                <p>We're thrilled to have you join the StayEase family! Your account has been created and is ready to use.</p>
                <p style="margin-top: 15px;">Get started today and discover amazing hotel deals, exclusive offers, and seamless booking experiences tailored just for you.</p>
            </div>

            <div class="info-box">
                <strong>Account Details:</strong><br>
                Email: {{ $userEmail }}<br>
                Status: Active and Ready to Use
            </div>

            <div class="message">
                <p>You can now:</p>
                <ul style="margin: 10px 0 10px 20px;">
                    <li>Browse exclusive hotel listings</li>
                    <li>Make quick and secure bookings</li>
                    <li>View your booking history</li>
                    <li>Enjoy personalized recommendations</li>
                </ul>
            </div>

            <a href="{{ env('APP_URL', 'http://localhost:3000') }}" class="cta-button">Start Exploring</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <strong>Thank you for choosing StayEase!</strong>
            <div class="footer-divider"></div>
            <p style="margin: 10px 0;">If you didn't create this account, please ignore this email or contact our support team.</p>
            <div class="footer-divider"></div>
            <div class="social-links">
                <a href="#">Facebook</a> • <a href="#">Twitter</a> • <a href="#">Instagram</a>
            </div>
            <div class="copyright">
                © {{ date('Y') }} StayEase. All rights reserved.<br>
                This is an automated email, please do not reply to this message.
            </div>
        </div>
    </div>
</body>
</html>
