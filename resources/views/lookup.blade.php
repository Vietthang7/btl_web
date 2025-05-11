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

        .table-responsive {
            margin-top: 20px;
        }

        .table {
            font-size: 14px;
        }

        .badge {
            padding: 5px 8px;
        }

        .alert-info {
            margin-top: 15px;
        }

        .modal-body img {
            max-width: 100%;
            max-height: 80vh;
            /* 80% chiều cao màn hình */
        }

        .img-thumbnail {
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.05);
            cursor: pointer;
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
                    <input type="text" class="form-control" id="licensePlate" name="license_plate"
                        placeholder="Ví dụ: 51H-123.45" value="{{ $licensePlate ?? '' }}">
                </div>
                <button type="submit" class="btn btn-search">Tra cứu</button>
            </form>
        </div>
    </div>

    <!-- Result Section -->
    <!-- Result Section -->
    @if($vehicle)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="result-section">
                    <h5>Kết quả tra cứu</h5>
                    <hr>
                    <p><strong>Biển số xe:</strong> {{ $vehicle->license_plate }}</p>
                    <p><strong>Chủ phương tiện:</strong> {{ $vehicle->owner->name }}</p>

                    @if($violations && count($violations) > 0)
                        <h6>Lịch sử vi phạm:</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Ngày vi phạm</th>
                                        <th>Loại vi phạm</th>
                                        <th>Địa điểm</th>
                                        <th>Mức phạt</th>
                                        <th>Trạng thái</th>
                                        <th>Minh chứng</th> <!-- Thêm cột này -->
                                    </tr>
                                </thead>
                                <!-- Thay đổi từ dòng 135 đến 174, thêm nút thanh toán tất cả ở dưới bảng -->
                                <tbody>
                                    @foreach($violations as $violation)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}</td>
                                            <td>{{ $violation->violation_type }}</td>
                                            <td>{{ $violation->location }}</td>
                                            <td>{{ number_format($violation->fine_amount) }} VNĐ</td>
                                            <td>
                                                @if($violation->payment_status == 'Unpaid')
                                                    <span class="badge bg-danger">Chưa thanh toán</span>
                                                @else
                                                    <span class="badge bg-success">Đã thanh toán</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($violation->evidence_image)
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#imageModal{{ $violation->id }}">
                                                        Xem ảnh
                                                    </button>

                                                    <!-- Modal hiển thị ảnh -->
                                                    <div class="modal fade" id="imageModal{{ $violation->id }}" tabindex="-1"
                                                        aria-labelledby="imageModalLabel{{ $violation->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="imageModalLabel{{ $violation->id }}">Ảnh
                                                                        minh chứng vi phạm ngày
                                                                        {{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset($violation->evidence_image) }}"
                                                                        alt="Ảnh minh chứng vi phạm" class="img-fluid">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted">Không có</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info">
                            @php
                                $unpaidViolations = $violations->where('payment_status', '!=', 'Paid');
                                $totalUnpaidAmount = $unpaidViolations->sum('fine_amount');
                                $unpaidViolationIds = $unpaidViolations->pluck('id')->toArray(); // Lấy danh sách IDs của các vi phạm chưa thanh toán
                            @endphp
                            <strong>Tổng số lần vi phạm:</strong> {{ count($violations) }} |
                            <strong>Tổng tiền phạt chưa thanh toán:</strong> {{ number_format($totalUnpaidAmount) }} VNĐ
                        </div>

                        @if(count($unpaidViolations) > 0)
                            <div class="text-center mt-3 mb-3">
                                <a href="{{ route('payment.show-all', ['ids' => implode(',', $unpaidViolationIds)]) }}"
                                    class="btn btn-danger btn-lg">
                                    <i class="fas fa-money-bill-wave me-2"></i> Thanh toán tất cả
                                    ({{ number_format($totalUnpaidAmount) }} VNĐ)
                                </a>
                            </div>
                        @endif
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

<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="WELCOME" chat-title="Hỗ_trợ_người_dùng" agent-id="e9e2ddfe-471d-4b3a-8562-3339780d54d1"
    language-code="vi"></df-messenger>