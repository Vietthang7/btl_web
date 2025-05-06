@extends('layouts.app')

@section('title', 'Tra Cứu Vi Phạm Giao Thông')

@section('styles')
    <style>
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
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .search-form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        .search-form .form-label {
            color: #0056b3;
            font-weight: bold;
        }
        .search-form .form-control {
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .search-form .btn-search {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            font-weight: bold;
        }
        .search-form .btn-search:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 86, 179, 0.4);
        }
        .result-section {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <!-- Banner -->
    <div class="banner">
        <h1>TRA CỨU PHƯƠNG TIỆN VI PHẠM GIAO THÔNG</h1>
        <div class="search-form">
            <form method="GET" action="{{ route('lookup') }}">
                <div class="mb-3">
                    <label for="licensePlate" class="form-label">Nhập biển số xe</label>
                    <input type="text" class="form-control" id="licensePlate" name="license_plate" placeholder="Ví dụ: 51H-123.45" value="{{ $licensePlate ?? '' }}">
                </div>
                <button type="submit" class="btn btn-search">Tra cứu</button>
            </form>
        </div>
    </div>

    <!-- Result Section -->
    @if($vehicle)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="result-section">
                    <h5>Kết quả tra cứu</h5>
                    <hr>
                    <p><strong>Biển số xe:</strong> {{ $vehicle->license_plate }}</p>
                    <p><strong>Chủ phương tiện:</strong> {{ $vehicle->owner_name }}</p>
                    @if($latestViolation)
                        <p><strong>Lần vi phạm gần nhất:</strong> {{ \Carbon\Carbon::parse($latestViolation->violation_date)->format('d/m/Y') }}</p>
                        <p><strong>Mức phạt:</strong> {{ number_format($latestViolation->fine_amount) }} VNĐ</p>
                        <p><strong>Chi tiết vi phạm:</strong> {{ $latestViolation->violation_type }} tại {{ $latestViolation->location }}</p>
                    @else
                        <p><strong>Không có vi phạm nào.</strong></p>
                    @endif
                </div>
            </div>
        </div>
    @elseif($licensePlate)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="result-section">
                    <h5>Kết quả tra cứu</h5>
                    <hr>
                    <p>Không tìm thấy phương tiện với biển số: {{ $licensePlate }}</p>
                </div>
            </div>
        </div>
    @endif
@endsection