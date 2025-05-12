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
    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
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
        /* Footer Styling - Phiên bản nâng cao */
        .footer-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            margin-top: 60px;
            border-radius: 16px 16px 0 0;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .footer-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/assets/img/pattern-bg.png');
            opacity: 0.05;
            z-index: 0;
        }

        .footer-content {
            position: relative;
            padding: 50px 0 30px;
            z-index: 1;
        }

        .footer-brand {
            margin-bottom: 20px;
        }

        .footer-logo {
            height: 50px;
            margin-bottom: 15px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .footer-logo:hover {
            transform: translateY(-3px);
        }

        .footer-brand h4 {
            font-weight: 700;
            font-size: 1.4rem;
            margin-top: 10px;
        }

        .footer-desc {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 20px;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .footer-social {
            display: flex;
            gap: 12px;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px);
            background-color: white;
            color: var(--primary-color);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer-heading {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: white;
            border-radius: 3px;
        }

        .footer-links {
            list-style: none;
            padding-left: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .footer-links li a i {
            margin-right: 10px;
            font-size: 0.8rem;
            transition: transform 0.3s ease;
        }

        .footer-links li a:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-links li a:hover i {
            transform: translateX(3px);
        }

        .footer-contact {
            list-style: none;
            padding-left: 0;
        }

        .footer-contact li {
            margin-bottom: 12px;
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
        }

        .footer-contact li i {
            min-width: 30px;
            color: white;
            margin-right: 10px;
            font-size: 1rem;
            transition: transform 0.3s ease;
        }

        .footer-contact li:hover i {
            transform: scale(1.2);
        }

        .footer-app-text {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 15px;
        }

        .footer-app-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .app-badge {
            display: block;
            transition: transform 0.3s ease;
        }

        .app-badge img {
            height: 40px;
            border-radius: 6px;
        }

        .app-badge:hover {
            transform: translateY(-3px);
        }

        .footer-copyright {
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .footer-copyright p {
            margin-bottom: 0;
        }

        .footer-copyright a {
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .footer-copyright a:hover {
            opacity: 0.8;
        }

        .current-time {
            opacity: 0.8;
        }

        /* Hiệu ứng chuyển động cho footer */
        @keyframes floatUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Footer */
        @media (max-width: 992px) {
            .footer-content {
                padding: 40px 0 20px;
            }
        }

        @media (max-width: 768px) {
            .footer-heading {
                margin-top: 20px;
            }
        }

        @media (max-width: 576px) {
            .footer-copyright {
                text-align: center;
            }

            .footer-copyright .text-md-start,
            .footer-copyright .text-md-end {
                text-align: center !important;
            }
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
            <div class="alert alert-success alert-dismissible fade show mt-4 animate__animated animate__slideInDown"
                role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-4 animate__animated animate__slideInDown"
                role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer-section">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- Logo & Thông tin -->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                        <div class="footer-brand">
                            <img src="{{ asset('assets/img/dcsvn.jpg') }}" alt="Traffic Logo" class="footer-logo">
                            <h4>Tra cứu vi phạm giao thông</h4>
                        </div>
                        <p class="footer-desc">
                            Hệ thống tra cứu vi phạm giao thông trực tuyến chính thức của Cục Cảnh sát giao thông Việt
                            Nam
                        </p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/obito12" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.facebook.com/obito12" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/obito12" class="social-icon"><i class="fab fa-youtube"></i></a>
                            <a href="https://www.facebook.com/obito12" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>

                    <!-- Liên kết nhanh -->
                    <div class="col-lg-2 col-md-6 col-sm-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                        <h5 class="footer-heading">Liên kết</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Trang chủ</a></li>
                            <li><a href="{{ route('lookup') }}"><i class="fas fa-angle-right"></i> Tra cứu</a></li>
                            <li><a href="#"><i class="fas fa-angle-right"></i> Tin tức</a></li>
                            <li><a href="#"><i class="fas fa-angle-right"></i> Hướng dẫn</a></li>
                            <li><a href="#"><i class="fas fa-angle-right"></i> Liên hệ</a></li>
                        </ul>
                    </div>

                    <!-- Liên hệ -->
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="300">
                        <h5 class="footer-heading">Liên hệ</h5>
                        <ul class="footer-contact">
                            <li><i class="fas fa-map-marker-alt"></i>245/120 Định Công, Hà Nội</li>
                            <li><i class="fas fa-phone-alt"></i> 1900 9208</li>
                            <li><i class="fas fa-envelope"></i> hotro@csgt.gov.vn</li>
                            <li><i class="fas fa-clock"></i> Thứ 2 - Thứ 6: 8:00 - 17:00</li>
                        </ul>
                    </div>

                    <!-- Tải ứng dụng -->
                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="400">
                        <h5 class="footer-heading">Tải ứng dụng</h5>
                        <p class="footer-app-text">Tra cứu vi phạm nhanh chóng qua ứng dụng di động</p>
                        <div class="footer-app-badges">
                            <a href="#" class="app-badge">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/2560px-Google_Play_Store_badge_EN.svg.png" alt="Google Play">
                            </a>
                            <a href="#" class="app-badge">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Download_on_the_App_Store_Badge.svg/2560px-Download_on_the_App_Store_Badge.svg.png" alt="App Store">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-copyright">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p>&copy; 2025 - Hệ thống tra cứu vi phạm giao thông</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p>Phát triển bởi <a href="https://github.com/Vietthang7" target="_blank">Nguyễn Viết Thắng</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-hide alerts script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                var alerts = document.querySelectorAll('.alert');
                alerts.forEach(function (alert) {
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    </script>

    @yield('scripts')
</body>

</html>