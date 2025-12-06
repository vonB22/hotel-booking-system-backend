<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful - StayEase</title>
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

        .login-details {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
            font-size: 13px;
            color: #555;
        }

        .login-details .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
        }

        .login-details .detail-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .login-details .label {
            font-weight: 600;
            color: #2c3e50;
        }

        .login-details .value {
            color: #555;
        }

        .security-note {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-size: 13px;
            color: #856404;
        }

        .security-note strong {
            color: #000;
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

            .login-details .detail-row {
                flex-direction: column;
            }

            .login-details .label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🔐 Login Successful</h1>
            <p>Welcome Back to StayEase</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">Hello {{ $userName }},</div>

            <div class="success-badge">✓ You've Successfully Logged In</div>

            <div class="message">
                <p>This is a confirmation that you've successfully logged into your StayEase account. Your session is now active and secure.</p>
            </div>

            <div class="login-details">
                <div class="detail-row">
                    <span class="label">Account Email:</span>
                    <span class="value">{{ $userEmail }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Login Time:</span>
                    <span class="value">{{ $loginTime }}</span>
                </div>
                <div class="detail-row">
                    <span class="label">Status:</span>
                    <span class="value">✓ Active</span>
                </div>
            </div>

            <div class="security-note">
                <strong>🔒 Security Reminder:</strong> If you didn't log in to your StayEase account, please change your password immediately and contact our support team.
            </div>

            <div class="message">
                <p>You can now:</p>
                <ul style="margin: 10px 0 10px 20px;">
                    <li>View available hotels and properties</li>
                    <li>Make new bookings</li>
                    <li>Check your booking history</li>
                    <li>Manage your account settings</li>
                </ul>
            </div>

            <a href="{{ env('APP_URL', 'http://localhost:3000') }}/dashboard" class="cta-button">Go to Dashboard</a>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <strong>Enjoy Your Stay with StayEase!</strong>
            <div class="footer-divider"></div>
            <p style="margin: 10px 0;">Questions or concerns? Our support team is here to help 24/7.</p>
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
