<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StayEase Backend API - Hotel Booking System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0e27;
            min-height: 100vh;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Premium animated background */
        .background-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        /* Animated gradient overlay */
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 50%, #1e1b4b 100%);
            background-size: 300% 300%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Floating particles */
        .particle {
            position: absolute;
            background: rgba(139, 92, 246, 0.15);
            border-radius: 50%;
            pointer-events: none;
            animation: float 20s infinite ease-in-out;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.3);
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
            animation-duration: 25s;
        }

        .particle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: -5s;
            animation-duration: 30s;
        }

        .particle:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: -10s;
            animation-duration: 22s;
        }

        .particle:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 30%;
            left: 70%;
            animation-delay: -15s;
            animation-duration: 28s;
        }

        .particle:nth-child(5) {
            width: 70px;
            height: 70px;
            top: 50%;
            left: 50%;
            animation-delay: -8s;
            animation-duration: 20s;
        }

        @keyframes float {
            0%, 100% { 
                transform: translate(0, 0) rotate(0deg) scale(1);
                opacity: 0.4;
            }
            25% { 
                transform: translate(30px, -40px) rotate(90deg) scale(1.1);
                opacity: 0.6;
            }
            50% { 
                transform: translate(-20px, -80px) rotate(180deg) scale(0.9);
                opacity: 0.3;
            }
            75% { 
                transform: translate(-50px, -40px) rotate(270deg) scale(1.05);
                opacity: 0.5;
            }
        }

        /* Geometric shapes */
        .geometric-shape {
            position: absolute;
            border: 2px solid rgba(139, 92, 246, 0.2);
            pointer-events: none;
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 5%;
            right: 10%;
            animation: morph 10s infinite ease-in-out;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            bottom: 10%;
            left: 5%;
            animation: pulse 8s infinite ease-in-out;
        }

        @keyframes morph {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            25% { border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%; }
            50% { border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%; }
            75% { border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.2; }
            50% { transform: scale(1.3); opacity: 0.4; }
        }

        /* Grid lines */
        .grid-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(139, 92, 246, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(139, 92, 246, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .container {
            position: relative;
            z-index: 10;
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(20px);
            padding: 30px 40px;
            border-radius: 20px;
            max-width: 1100px;
            width: 100%;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(139, 92, 246, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 95vh;
            overflow: hidden;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 20px;
        }

        .logo-title {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.4);
            position: relative;
            overflow: hidden;
            animation: logoPulse 3s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes logoPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        .logo svg {
            width: 30px;
            height: 30px;
            stroke: white;
            position: relative;
            z-index: 1;
        }

        .title-group {
            flex: 1;
        }

        h1 {
            font-size: 28px;
            background: linear-gradient(135deg, #a78bfa, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 14px;
            color: #94a3b8;
            font-weight: 500;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            animation: statusPulse 2s ease-in-out infinite;
            flex-shrink: 0;
        }

        @keyframes statusPulse {
            0%, 100% { box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3); }
            50% { box-shadow: 0 4px 20px rgba(16, 185, 129, 0.5); }
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 3fr;
            gap: 25px;
            margin-bottom: 25px;
        }

        .info-section {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .info-card {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(99, 102, 241, 0.05) 100%);
            padding: 16px;
            border-radius: 12px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.2);
            border-color: rgba(139, 92, 246, 0.4);
        }

        .info-card:hover::before {
            transform: scaleY(1);
        }

        .info-card h3 {
            font-size: 10px;
            font-weight: 700;
            color: #a78bfa;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-icon {
            width: 12px;
            height: 12px;
            display: inline-block;
        }

        .info-card p {
            font-size: 14px;
            color: #e2e8f0;
            font-weight: 600;
        }

        .api-section {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(37, 99, 235, 0.05) 100%);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .api-section h4 {
            color: #93c5fd;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .api-section code {
            background: rgba(0, 0, 0, 0.3);
            padding: 10px 14px;
            border-radius: 8px;
            font-family: 'Monaco', 'Courier New', monospace;
            font-size: 11px;
            color: #60a5fa;
            display: block;
            margin-bottom: 10px;
            border: 1px solid rgba(59, 130, 246, 0.2);
            overflow-x: auto;
            white-space: nowrap;
        }

        .api-note {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.5;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 24px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(139, 92, 246, 0.4);
        }

        .btn-icon {
            width: 16px;
            height: 16px;
            position: relative;
            z-index: 1;
        }

        .footer {
            text-align: center;
            color: #64748b;
            font-size: 11px;
            padding-top: 20px;
            border-top: 1px solid rgba(139, 92, 246, 0.1);
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .footer-link {
            color: #818cf8;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            font-size: 11px;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #818cf8;
            transition: width 0.3s ease;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .footer-link:hover {
            color: #a78bfa;
        }

        @media (max-width: 900px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            .container {
                padding: 25px 20px;
            }
            
            h1 {
                font-size: 22px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .logo-title {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }

    </style>
</head>

<body>
    <!-- Premium Background Animation -->
    <div class="background-animation">
        <div class="gradient-overlay"></div>
        <div class="grid-lines"></div>
        
        <!-- Floating Particles -->
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        
        <!-- Geometric Shapes -->
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
    </div>

    <div class="container">
        <!-- Header Section -->
        <div class="header-section">
            <div class="logo-title">
                <div class="logo">
                    <svg fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M3 21V8l9-5 9 5v13"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                </div>
                <div class="title-group">
                    <h1>StayEase Backend API</h1>
                    <p class="subtitle">Enterprise Hotel Booking System</p>
                </div>
            </div>
            <div class="status-badge">
                <span class="status-dot"></span>
                <span>Server Online</span>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Left: System Information -->
            <div class="info-section">
                <div class="info-grid">
                    <div class="info-card">
                        <h3>
                            <svg class="info-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                            </svg>
                            Framework
                        </h3>
                        <p>Laravel Framework 12.35.1</p>
                    </div>
                    <div class="info-card">
                        <h3>
                            <svg class="info-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Environment
                        </h3>
                        <p>Production</p>
                    </div>
                    <div class="info-card">
                        <h3>
                            <svg class="info-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                            PHP Version
                        </h3>
                        <p>8.2.28</p>
                    </div>
                    <div class="info-card">
                        <h3>
                            <svg class="info-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                            </svg>
                            Database
                        </h3>
                        <p>MySQL</p>
                    </div>
                </div>
            </div>

            <!-- Right: API Information -->
            <div class="api-section">
                <div>
                    <h4>
                        <svg class="info-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        API Base URL
                    </h4>
                    <code>https://hotel-booking-system-backend-0tc6.onrender.com/api</code>
                    <p class="api-note">All API endpoints are prefixed with <code style="display: inline; padding: 2px 6px; margin: 0; font-size: 10px;">/api</code> and require proper authentication headers for secured routes.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="buttons">
            <a href="#" class="btn btn-primary">
                <svg class="btn-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>View API Documentation</span>
            </a>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>StayEase Backend API v1.0.0 • Built with Laravel</p>
            <div class="footer-links">
                <a href="#" class="footer-link">Documentation</a>
                <a href="#" class="footer-link">Laravel</a>
                <a href="#" class="footer-link">Support</a>
            </div>
        </div>
    </div>

</body>
</html>
