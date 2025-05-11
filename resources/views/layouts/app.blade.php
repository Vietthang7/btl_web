<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hệ thống tra cứu vi phạm giao thông')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #0056b3;
            --secondary-color: #00aaff;
            --light-blue: #d1e8ff;
            --dark-blue: #004494;
            --text-color: #333333;
            --bg-color: #f0f7ff;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        body {
            background-color: var(--bg-color);
            font-family: 'Roboto', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        /* Navbar Styling */
        .navbar {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }
        
        .navbar-brand img {
            height: 45px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        .navbar-nav .nav-link {
            color: white !important;
            position: relative;
            transition: all 0.3s ease;
            padding: 10px 18px;
            font-weight: 500;
            border-radius: 8px;
            margin: 0 5px;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--light-blue) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            background-color: var(--light-blue);
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }
        
        .navbar-nav .nav-link.active {
            background-color: white;
            color: var(--primary-color) !important;
            border-radius: 8px;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        /* Footer Styling */
        .footer {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            margin-top: 60px;
            padding: 30px 0;
            border-radius: 16px 16px 0 0;
        }
        
        .footer p {
            margin-bottom: 0;
            font-weight: 500;
        }
        
        /* Button Styling */
        .btn {
            transition: all 0.3s ease;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 25px;
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, var(--dark-blue), var(--primary-color));
        }
        
        /* Card Styling */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        /* Alert Styling */
        .alert {
            border-radius: 12px;
            padding: 15px 20px;
            margin: 20px 0;
            border: none;
            display: flex;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            animation: slideInDown 0.5s ease-in-out;
        }
        
        .alert-success {
            background: linear-gradient(to right, #28a745, #5cb85c);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(to right, #dc3545, #f86b7c);
            color: white;
        }
        
        .alert i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .btn-close {
            margin-left: auto;
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        
        .btn-close:hover {
            opacity: 1;
        }
        
        /* Animation Keyframes */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        /* Chatbot styling */
        df-messenger {
            --df-messenger-bot-message: var(--primary-color);
            --df-messenger-button-titlebar-color: var(--primary-color);
            --df-messenger-chat-background-color: #fafafa;
            --df-messenger-font-color: white;
            --df-messenger-send-icon: var(--primary-color);
            --df-messenger-user-message: var(--secondary-color);
            z-index: 999 !important;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('assets/img/dcsvn.jpg') }}" alt="Traffic Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('lookup') ? 'active' : '' }}" href="{{ route('lookup') }}">
                            <i class="fas fa-search me-1"></i> Tra cứu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-info-circle me-1"></i> Hướng dẫn
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-phone-alt me-1"></i> Liên hệ
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4 animate__animated animate__slideInDown" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-4 animate__animated animate__slideInDown" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="container">
        <footer class="footer">
            <p>© 2025 - Hệ thống tra cứu vi phạm giao thông | Phát triển bởi VietThang7</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-hide alerts script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    
    @yield('scripts')
</body>
</html>