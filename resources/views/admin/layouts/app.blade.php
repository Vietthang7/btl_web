<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Hệ thống tra cứu vi phạm giao thông')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary: #0056b3;
            --secondary: #6c757d;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background: linear-gradient(to bottom, #0056b3, #004494);
            color: #fff;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px 15px;
            text-align: center;
            background: rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            border-left: 4px solid #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .navbar-admin {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .card-admin {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            background-color: #fff;
        }

        .card-admin .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            font-weight: bold;
            padding: 15px 20px;
        }

        .card-admin .card-body {
            padding: 20px;
        }

        .stats-card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            color: #fff;
            transition: all 0.3s;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card-primary {
            background: linear-gradient(to right, #0056b3, #007bff);
        }

        .stats-card-success {
            background: linear-gradient(to right, #28a745, #5cb85c);
        }

        .stats-card-danger {
            background: linear-gradient(to right, #dc3545, #ff4d5a);
        }

        .stats-card-warning {
            background: linear-gradient(to right, #ffc107, #ffdb58);
        }

        .stats-card .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .stats-card .stats-number {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stats-card .stats-title {
            font-size: 1rem;
            font-weight: normal;
        }

        .btn-admin {
            border-radius: 5px;
            padding: 8px 15px;
            transition: all 0.3s;
            font-weight: bold;
        }

        .btn-admin-primary {
            background-color: #0056b3;
            color: #fff;
            border: none;
        }

        .btn-admin-primary:hover {
            background-color: #004494;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-admin-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-admin-success:hover {
            background-color: #218838;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-admin-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }

        .btn-admin-danger:hover {
            background-color: #c82333;
            color: #fff;
            transform: translateY(-2px);
        }

        .table-admin {
            width: 100%;
        }

        .table-admin th {
            background-color: #f5f5f5;
            border-bottom: 2px solid #ddd;
            font-weight: bold;
        }

        .table-admin td,
        .table-admin th {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .table-admin tbody tr:hover {
            background-color: #f8f9fa;
        }

        .form-admin .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }

        .form-admin .form-label {
            font-weight: bold;
            color: #555;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }

        .dropdown-menu {
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 8px 15px;
        }

        .dropdown-item:hover {
            background-color: #f5f5f5;
        }

        .alert {
            border-radius: 5px;
            font-weight: bold;
        }

        .admin-footer {
            margin-left: 250px;
            padding: 15px 20px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            border-top: 1px solid #eee;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
                overflow: hidden;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar-header h4 {
                display: none;
            }

            .content {
                margin-left: 60px;
            }

            .admin-footer {
                margin-left: 60px;
            }

            .sidebar .nav-link i {
                margin-right: 0;
                font-size: 1.2rem;
            }

            /* Hiển thị tooltip khi hover trên menu */
            .sidebar .nav-link {
                position: relative;
            }

            .sidebar .nav-link:hover:before {
                content: attr(data-title);
                position: absolute;
                left: 100%;
                top: 0;
                background: #004494;
                padding: 5px 10px;
                border-radius: 3px;
                white-space: nowrap;
                z-index: 1001;
            }
            
            .card-header {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .stats-card {
                margin-bottom: 15px;
            }
        }

        /* Media query cho màn hình rất nhỏ */
        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                position: fixed;
                transform: translateX(-250px);
            }

            .sidebar.show {
                width: 250px;
                transform: translateX(0);
            }
            
            .sidebar.show .nav-link span {
                display: inline-block;
            }

            .content,
            .admin-footer {
                margin-left: 0;
            }

            .navbar-admin .toggle-sidebar {
                display: block !important;
            }
            
            .navbar-admin h4 {
                font-size: 1.2rem;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start !important;
            }
            
            .card-header a {
                margin-top: 10px;
            }
            
            .d-flex.gap-2 {
                margin-bottom: 5px;
            }
        }

        /* Ẩn nút toggle-sidebar mặc định */
        .toggle-sidebar {
            display: none;
        }
        
        /* Thêm khoảng cách giữa các nút */
        .d-flex.gap-2 {
            gap: 0.5rem !important;
        }
    </style>

    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4>Quản Trị Hệ Thống</h4>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.owners*') ? 'active' : '' }}" href="{{ route('admin.owners') }}">
                    <i class="fas fa-user"></i> <span>Chủ Phương Tiện</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.vehicles*') ? 'active' : '' }}"
                    href="{{ route('admin.vehicles') }}">
                    <i class="fas fa-car"></i> <span>Phương Tiện</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.violations*') ? 'active' : '' }}"
                    href="{{ route('admin.violations') }}">
                    <i class="fas fa-exclamation-triangle"></i> <span>Vi Phạm</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.traffic-situations.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.traffic-situations.index') }}">
                    <i class="fas fa-road"></i> <span>Tình Hình Giao Thông</span>
                </a>
            </li>
            @if(Auth::guard('admin')->user()->role == 'super_admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('admin.admins*') ? 'active' : '' }}" href="{{ route('admin.admins') }}">
                        <i class="fas fa-users-cog"></i> <span>Quản Lý Admin</span>
                    </a>
                </li>
            @endif
            <li class="nav-item mt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent">
                        <i class="fas fa-sign-out-alt"></i> <span>Đăng xuất</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Navbar -->
        <div class="navbar-admin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="toggle-sidebar btn btn-sm btn-light d-md-none me-2">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                </div>
                <div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::guard('admin')->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>
                                        Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="admin-footer">
        <p>&copy; 2025 - Hệ thống tra cứu vi phạm giao thông. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        // Script mặc định của bạn

        // Thêm đoạn code này để xử lý toggle sidebar
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.querySelector('.toggle-sidebar');
            const sidebar = document.querySelector('.sidebar');

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }

            // Đóng sidebar khi click ra ngoài (trên màn hình nhỏ)
            document.addEventListener('click', function (event) {
                if (window.innerWidth <= 576) {
                    const isClickInsideSidebar = sidebar.contains(event.target);
                    const isClickInsideToggleBtn = toggleBtn && toggleBtn.contains(event.target);

                    if (!isClickInsideSidebar && !isClickInsideToggleBtn && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                }
            });

            // Thêm data-title cho các menu item
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(function (link) {
                const text = link.textContent.trim();
                link.setAttribute('data-title', text);
            });
            
            // Cập nhật lại chiều cao của các card trong dòng flex để chúng bằng nhau
            function updateCardHeights() {
                const rows = document.querySelectorAll('.row');
                rows.forEach(row => {
                    if (window.innerWidth >= 992) {
                        const cards = row.querySelectorAll('.card-admin');
                        let maxHeight = 0;
                        
                        // Reset heights
                        cards.forEach(card => {
                            card.style.height = 'auto';
                            const height = card.offsetHeight;
                            maxHeight = Math.max(maxHeight, height);
                        });
                        
                        // Set all cards to max height
                        if (cards.length > 1) {
                            cards.forEach(card => {
                                card.style.height = maxHeight + 'px';
                            });
                        }
                    } else {
                        // Reset heights on smaller screens
                        const cards = row.querySelectorAll('.card-admin');
                        cards.forEach(card => {
                            card.style.height = 'auto';
                        });
                    }
                });
            }
            
            // Run on load
            updateCardHeights();
            
            // Run on window resize
            window.addEventListener('resize', updateCardHeights);
        });
    </script>
    @yield('scripts')
</body>

</html>