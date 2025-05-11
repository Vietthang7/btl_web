@extends('layouts.app')

@section('title', 'Trang Chủ - Tra Cứu Vi Phạm Giao Thông')

@section('styles')
    <style>
        .news-section,
        .traffic-section,
        .faq-section,
        .statistics-section {
            margin-bottom: 40px;
        }

        .news-section .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 200px;
            object-fit: cover;
        }

        .news-section .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
        }

        .news-section .card-text {
            flex-grow: 1;
            margin-bottom: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .traffic-section .list-group-item {
            border: none;
            padding: 15px;
        }

        .faq-section .accordion-button {
            background-color: #0056b3;
            color: white;
            border-radius: 8px;
        }

        .faq-section .accordion-button:not(.collapsed) {
            background-color: #004494;
        }

        .faq-section .accordion-body {
            background-color: white;
            border-radius: 8px;
        }

        .statistics-section .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s;
            height: 100%;
            /* Đảm bảo các card có cùng chiều cao */
        }

        .statistics-section .card:hover {
            transform: translateY(-5px);
        }

        .statistics-section .card-header {
            background-color: #0056b3;
            color: white;
            font-weight: bold;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
            text-align: center;
            font-size: 18px;
        }

        .statistics-section .chart-container {
            height: 300px;
        }

        .stat-item {
            border-left: 3px solid #0056b3;
            padding-left: 15px;
            margin-bottom: 20px;
        }

        .stat-item h4 {
            color: #0056b3;
            font-weight: bold;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
            color: #0056b3;
        }

        .top-violations {
            padding: 0;
            margin: 0;
        }

        .top-violations li {
            padding: 12px 5px;
            border-bottom: 1px dashed #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-violations li:last-child {
            border-bottom: none;
        }

        .violation-count-badge {
            background-color: #0056b3;
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .violation-type {
            flex-grow: 1;
        }
    </style>
@endsection

@section('content')
    <!-- Banner -->
    <div class="banner">
        <h1>TRA CỨU VI PHẠM GIAO THÔNG NHANH CHÓNG</h1>
        <p>Kiêm tra thông tin vi phạm giao thông của phương tiện chỉ với vài bước đơn giản.</p>
        <a href="{{ route('lookup') }}" class="btn btn-lookup">Tra cứu ngay</a>
    </div>

    <!-- Statistics Section -->
    <div class="statistics-section">
        <h2 class="text-center mb-4" style="color: #0056b3;">Thống Kê Vi Phạm</h2>
        <div class="row">
            <!-- Row 1: Hai card đầu tiên -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Loại xe vi phạm nhiều nhất
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        @if(isset($mostViolatedVehicleType))
                            <h3 class="stat-value">{{ $mostViolatedVehicleType->type }}</h3>
                            <p class="text-center">Với {{ $mostViolatedVehicleType->violation_count }} vi phạm</p>
                        @else
                            <p class="text-center">Không có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Top 3 lỗi vi phạm phổ biến
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled top-violations">
                            @forelse($topViolationTypes as $index => $violation)
                                <li>
                                    <div class="violation-type">
                                        <strong>{{ $index + 1 }}. </strong>{{ $violation->violation_type }}
                                    </div>
                                    <span class="violation-count-badge">{{ $violation->count }}</span>
                                </li>
                            @empty
                                <li class="text-center">Không có dữ liệu vi phạm</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Row 2: Biểu đồ -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Số lượng vi phạm theo tháng năm {{ date('Y') }}
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="violationsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Traffic Situation Section -->
     <div class="traffic-section">
        <h2 class="text-center mb-4 mt-4" style="color: #0056b3;">Tình Hình Giao Thông</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @forelse($trafficSituations as $situation)
                                <li class="list-group-item">
                                    <strong>{{ $situation->location }}, {{ $situation->city }}:</strong>
                                    {{ $situation->status }}
                                    <div class="small text-muted mt-1">Cập nhật:
                                        {{ $situation->updated_at->format('d/m/Y H:i') }}</div>
                                </li>
                            @empty
                                <li class="list-group-item">Không có thông tin tình hình giao thông.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- News Section -->
    <div class="news-section">
        <h2 class="text-center mb-4 mt-4" style="color: #0056b3;">Tin Tức Giao Thông</h2>
        <div class="row">
            @foreach($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('assets/img/' . $item['image']) }}" class="card-img-top" alt="{{ $item['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text">{{ $item['description'] }}</p>
                            <a href="#" class="btn btn-detail">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



    <!-- FAQ Section -->
    <div class="faq-section">
        <h2 class="text-center mb-4 mt-4" style="color: #0056b3;">Câu Hỏi Thường Gặp (FAQ)</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="faq{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Biểu đồ vi phạm theo tháng
            const violationsCtx = document.getElementById('violationsChart').getContext('2d');
            new Chart(violationsCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Số lượng vi phạm',
                        data: {!! json_encode($violationCounts) !!},
                        backgroundColor: 'rgba(0, 86, 179, 0.7)',
                        borderColor: 'rgba(0, 86, 179, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượng vi phạm'
                            },
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="WELCOME" chat-title="Hỗ_trợ_người_dùng" agent-id="e9e2ddfe-471d-4b3a-8562-3339780d54d1"
    language-code="vi"></df-messenger>