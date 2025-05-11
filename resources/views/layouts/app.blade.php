<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hệ thống tra cứu vi phạm giao thông')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e6f0fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #0056b3;
        }
        .navbar-brand img {
            height: 40px;
        }
        .navbar-nav .nav-link {
            color: white !important;
            position: relative;
            transition: all 0.3s ease;
            padding: 8px 15px;
        }
        .navbar-nav .nav-link:hover {
            color: #d1e8ff !important;
            transform: scale(1.1);
        }
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #d1e8ff;
            bottom: 0;
            left: 0;
            transition: width 0.3s ease;
        }
        .navbar-nav .nav-link:hover::after {
            width: 100%;
        }
        .navbar-nav .nav-link.active {
            background-color: #d1e8ff;
            color: #0056b3 !important;
            border-radius: 5px;
        }
        .footer {
            color: #0056b3;
            text-align: center;
            margin-top: 30px;
            padding: 20px 0;
        }
        /* CSS chung cho các nút và card */
        .btn-lookup, .btn-search, .btn-detail {
            border: none;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-lookup {
            background: #ffffff;
            color: #0056b3;
            padding: 12px 30px;
        }
        .btn-lookup:hover {
            background: #d1e8ff;
            transform: scale(1.05);
            color:black;
            box-shadow: 0 4px 15px rgba(0, 86, 179, 0.4);
        }
        .btn-search {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            padding: 12px;
            width: 100%;
        }
        .btn-search:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 86, 179, 0.4);
        }
        .btn-detail {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            padding: 8px 20px;
        }
        .btn-detail:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 86, 179, 0.4);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        /* Banner style */
        .banner {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 30px;
            margin-top: 20px;
        }
        .banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .banner p {
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        
        /* Thêm style cho alert messages */
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            animation: fadeIn 0.5s ease;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @yield('styles')
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
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
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('lookup') ? 'active' : '' }}" href="{{ route('lookup') }}">Tra cứu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hướng dẫn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        <!-- Thêm phần hiển thị thông báo ở đây -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>© 2025 - Hệ thống tra cứu vi phạm giao thông. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Thêm script để tự động ẩn thông báo sau 5 giây -->
    <script>
        // Auto-hide alerts after 5 seconds
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