<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - Hệ thống tra cứu vi phạm giao thông</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            width: 400px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        
        .login-header {
            background: linear-gradient(90deg, #0056b3, #004494);
            color: white;
            padding: 20px;
            text-align: center;
        }
        
        .login-header h4 {
            margin: 0;
            font-weight: bold;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .login-form .form-control {
            border-radius: 5px;
            padding: 12px 15px;
            border: 1px solid #ddd;
        }
        
        .login-form .form-label {
            font-weight: bold;
            color: #555;
        }
        
        .btn-login {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px;
            width: 100%;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.4);
        }
        
        .login-footer {
            text-align: center;
            padding: 15px 0;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h4>ĐĂNG NHẬP QUẢN TRỊ</h4>
        </div>
        
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class="login-form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email đăng nhập</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" value="{{ old('email') }}" required>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                
                <button type="submit" class="btn btn-login">Đăng nhập</button>
            </form>
        </div>
        
        <div class="login-footer">
            <p class="mb-0">Hệ thống tra cứu vi phạm giao thông</p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>