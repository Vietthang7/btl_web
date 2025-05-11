@extends('layouts.app')

@section('title', 'Tra Cứu Vi Phạm Giao Thông')

@section('styles')
    <style>
        /* Banner and container styling */
        .lookup-banner {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 16px;
            margin-bottom: 40px;
            margin-top: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 86, 179, 0.3);
        }

        .lookup-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/img/pattern-bg.png') }}');
            opacity: 0.1;
            z-index: 0;
        }
        
        .lookup-banner .container {
            position: relative;
            z-index: 1;
        }

        .lookup-banner h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 30px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }
        
        /* Search form styling */
        .search-container {
            max-width: 500px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 1;
            transform: translateY(0);
            transition: all 0.4s ease;
        }
        
        .search-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        
        .search-form .form-label {
            color: #0056b3;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 12px;
        }
        
        .search-form .form-control {
            border: 2px solid rgba(0, 86, 179, 0.2);
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1.1rem;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        
        .search-form .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
        }
        
        .search-form .form-text {
            color: #666;
            margin-top: -15px;
            margin-bottom: 20px;
        }
        
        .search-form .btn-search {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }
        
        .search-form .btn-search:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 86, 179, 0.4);
        }
        
        /* Result styling */
        .result-container {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 40px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .result-container:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        
        .result-header {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            padding: 20px 25px;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }
        
        .result-header h5 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .result-body {
            padding: 30px;
        }
        
        .vehicle-info {
            background-color: #f8f9ff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            border-left: 5px solid #0056b3;
        }
        
        .vehicle-info p {
            margin-bottom: 12px;
            font-size: 1.05rem;
        }
        
        .vehicle-info p:last-child {
            margin-bottom: 0;
        }
        
        .vehicle-info strong {
            color: #0056b3;
        }
        
        /* Table styling */
        .table-title {
            color: #0056b3;
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 1.2rem;
            position: relative;
            padding-left: 20px;
        }
        
        .table-title::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 25px;
            background-color: #0056b3;
            border-radius: 4px;
        }
        
        .violations-table {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        .violations-table .table {
            margin-bottom: 0;
        }
        
        .violations-table thead {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
        }
        
        .violations-table th {
            font-weight: 600;
            border: none !important;
            padding: 15px !important;
            font-size: 1rem;
        }
        
        .violations-table td {
            padding: 15px !important;
            vertical-align: middle;
            font-size: 0.95rem;
            border-color: #eaeaea !important;
        }
        
        .violations-table tr:hover {
            background-color: #f8f9ff;
        }
        
        /* Badge styling */
        .badge {
            padding: 8px 15px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
        }
        
        .badge.bg-success {
            background: linear-gradient(90deg, #28a745, #5cb85c) !important;
            box-shadow: 0 3px 6px rgba(40, 167, 69, 0.2);
        }
        
        .badge.bg-danger {
            background: linear-gradient(90deg, #dc3545, #f86b7c) !important;
            box-shadow: 0 3px 6px rgba(220, 53, 69, 0.2);
        }
        
        /* Summary box */
        .summary-box {
            background: linear-gradient(135deg, #f8f9ff, #ffffff);
            border-radius: 12px;
            padding: 20px 25px;
            margin-top: 30px;
            border: 1px solid #e0e7ff;
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.08);
        }
        
        .summary-box strong {
            color: #0056b3;
        }
        
        /* Button styling */
        .btn-view-image {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-view-image:hover {
            background: linear-gradient(90deg, #004494, #0088cc);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 12px rgba(0, 86, 179, 0.3);
        }
        
        .btn-pay-all {
            background: linear-gradient(90deg, #dc3545, #f86b7c);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 15px 30px;
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .btn-pay-all:hover {
            background: linear-gradient(90deg, #c82333, #e95f70);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(220, 53, 69, 0.3);
        }
        
        /* Modal styling */
        .modal-content {
            border-radius: 16px;
            overflow: hidden;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            border: none;
            padding: 20px;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .modal-footer {
            border-top: 1px solid #eaeaea;
            padding: 15px 20px;
        }
        
        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #c8d6e5;
            margin-bottom: 20px;
        }
        
        .empty-state-text {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 0;
        }
        
        /* Image hover effect */
        .modal-img {
            transition: transform 0.5s ease;
        }
        
        .modal-img:hover {
            transform: scale(1.05);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .lookup-banner h1 {
                font-size: 1.8rem;
            }
            
            .vehicle-info {
                padding: 15px;
            }
            
            .violations-table td, 
            .violations-table th {
                padding: 10px !important;
            }
            
            .btn-view-image {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Lookup Banner -->
    <div class="lookup-banner">
        <div class="container">
            <h1>TRA CỨU PHƯƠNG TIỆN VI PHẠM GIAO THÔNG</h1>
            <div class="search-container">
                <form method="GET" action="{{ route('lookup') }}" class="search-form">
                    <div class="mb-4">
                        <label for="licensePlate" class="form-label">
                            <i class="fas fa-car me-2"></i> Nhập biển số xe
                        </label>
                        <input type="text" class="form-control" id="licensePlate" name="license_plate"
                            placeholder="Ví dụ: 51H-123.45" value="{{ $licensePlate ?? '' }}">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i> Nhập đúng định dạng biển số xe (bao gồm cả dấu gạch ngang)
                        </div>
                    </div>
                    <button type="submit" class="btn btn-search">
                        <i class="fas fa-search me-2"></i> Tra cứu
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Result Section -->
    @if($vehicle)
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="result-container">
                    <div class="result-header">
                        <h5><i class="fas fa-clipboard-check me-2"></i> Kết quả tra cứu</h5>
                    </div>
                    <div class="result-body">
                        <div class="vehicle-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-car me-2"></i>Biển số xe:</strong> {{ $vehicle->license_plate }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong><i class="fas fa-user me-2"></i>Chủ phương tiện:</strong> {{ $vehicle->owner->name }}</p>
                                </div>
                            </div>
                        </div>

                        @if($violations && count($violations) > 0)
                            <h6 class="table-title">Lịch sử vi phạm</h6>
                            <div class="violations-table">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">Ngày vi phạm</th>
                                                <th style="width: 25%">Loại vi phạm</th>
                                                <th style="width: 20%">Địa điểm</th>
                                                <th style="width: 15%">Mức phạt</th>
                                                <th style="width: 15%">Trạng thái</th>
                                                <th style="width: 10%">Minh chứng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($violations as $violation)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}</td>
                                                    <td>{{ $violation->violation_type }}</td>
                                                    <td>{{ $violation->location }}</td>
                                                    <td>{{ number_format($violation->fine_amount) }} VNĐ</td>
                                                    <td>
                                                        @if($violation->payment_status == 'Paid')
                                                            <span class="badge bg-success">
                                                                <i class="fas fa-check-circle me-1"></i> Đã thanh toán
                                                            </span>
                                                        @else
                                                            <span class="badge bg-danger">
                                                                <i class="fas fa-times-circle me-1"></i> Chưa thanh toán
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($violation->evidence_image)
                                                            <button type="button" class="btn btn-view-image" data-bs-toggle="modal"
                                                                data-bs-target="#imageModal{{ $violation->id }}">
                                                                <i class="fas fa-image me-1"></i> Xem
                                                            </button>

                                                            <!-- Modal hiển thị ảnh -->
                                                            <div class="modal fade" id="imageModal{{ $violation->id }}" tabindex="-1"
                                                                aria-labelledby="imageModalLabel{{ $violation->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="imageModalLabel{{ $violation->id }}">
                                                                                <i class="fas fa-camera me-2"></i>
                                                                                Ảnh minh chứng vi phạm - {{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}
                                                                            </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <img src="{{ asset($violation->evidence_image) }}"
                                                                                alt="Ảnh minh chứng vi phạm" class="img-fluid modal-img">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <span class="text-muted"><i class="fas fa-ban me-1"></i> Không có</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="summary-box">
                                @php
                                    $unpaidViolations = $violations->where('payment_status', '!=', 'Paid');
                                    $totalUnpaidAmount = $unpaidViolations->sum('fine_amount');
                                    $unpaidViolationIds = $unpaidViolations->pluck('id')->toArray();
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-exclamation-circle me-2"></i>Tổng số lần vi phạm:</strong> {{ count($violations) }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong><i class="fas fa-money-bill-wave me-2"></i>Tổng tiền phạt chưa thanh toán:</strong> {{ number_format($totalUnpaidAmount) }} VNĐ</p>
                                    </div>
                                </div>
                            </div>

                            @if(count($unpaidViolations) > 0)
                                <div class="text-center mt-4">
                                    <a href="{{ route('payment.show-all', ['ids' => implode(',', $unpaidViolationIds)]) }}"
                                        class="btn btn-pay-all">
                                        <i class="fas fa-money-bill-wave me-2"></i> Thanh toán tất cả
                                        ({{ number_format($totalUnpaidAmount) }} VNĐ)
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <p class="empty-state-text">Phương tiện này không có vi phạm nào.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif($licensePlate)
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="result-container">
                    <div class="result-header">
                        <h5><i class="fas fa-search me-2"></i> Kết quả tra cứu</h5>
                    </div>
                    <div class="result-body">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <p class="empty-state-text">Không tìm thấy phương tiện nào với biển số: <strong>{{ $licensePlate }}</strong></p>
                            <p class="mt-3 text-muted">Vui lòng kiểm tra lại biển số và thử lại.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection

<!-- Chatbot -->
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="WELCOME" chat-title="Hỗ_trợ_người_dùng" agent-id="e9e2ddfe-471d-4b3a-8562-3339780d54d1"
    language-code="vi"></df-messenger>