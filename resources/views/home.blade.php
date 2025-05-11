@extends('layouts.app')

@section('title', 'Trang Chủ - Tra Cứu Vi Phạm Giao Thông')

@section('styles')
    <style>
        /* Banner cải tiến */
        .hero-banner {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 16px;
            margin-bottom: 50px;
            margin-top: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 86, 179, 0.3);
        }
        
        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/img/traffic-pattern.png') }}');
            background-size: cover;
            opacity: 0.1;
            z-index: 0;
        }
        
        .hero-banner .container {
            position: relative;
            z-index: 1;
        }
        
        .hero-banner h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            letter-spacing: 1px;
        }
        
        .hero-banner p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-banner .btn-lookup {
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
        }
        
        .hero-banner .btn-lookup:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        /* Sections styling */
        .section-heading {
            position: relative;
            font-size: 2rem;
            font-weight: 700;
            color: #0056b3;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            text-align: center;
        }
        
        .section-heading::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 4px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(90deg, #0056b3, #00aaff);
            border-radius: 2px;
        }
        
        .section-container {
            background-color: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 50px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }
        
        .section-container:hover {
            transform: translateY(-5px);
        }

        /* Stats section */
        .statistics-section .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
            overflow: hidden;
        }
        
        .statistics-section .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 86, 179, 0.15);
        }
        
        .statistics-section .card-header {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            font-weight: 600;
            font-size: 1.2rem;
            border-bottom: none;
            padding: 20px;
            text-align: center;
        }
        
        .statistics-section .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 25px 0;
            background: linear-gradient(90deg, #0056b3, #00aaff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }
        
        .statistics-section .chart-container {
            height: 350px;
            padding: 20px;
        }

        /* List items styling */
        .top-violations li {
            padding: 15px 10px;
            border-bottom: 1px dashed #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }
        
        .top-violations li:last-child {
            border-bottom: none;
        }
        
        .top-violations li:hover {
            background-color: #f8f9ff;
        }
        
        .top-violations .violation-count-badge {
            background: linear-gradient(90deg, #0056b3, #00aaff);
            color: white;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 3px 8px rgba(0, 86, 179, 0.2);
        }
        
        .violation-type {
            flex-grow: 1;
            padding-right: 15px;
        }

        /* Traffic section */
        .traffic-situation-item {
            background-color: white;
            border-radius: 12px;
            margin-bottom: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid #0056b3;
            transition: all 0.3s ease;
        }
        
        .traffic-situation-item:hover {
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .traffic-situation-item .location {
            font-weight: 700;
            color: #0056b3;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }
        
        .traffic-situation-item .status {
            margin-bottom: 8px;
        }
        
        .traffic-situation-item .time {
            font-size: 0.85rem;
            color: #888;
        }

        /* News section */
        .news-section .card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            height: 100%;
        }
        
        .news-section .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .news-section .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .news-section .card:hover .card-img-top {
            transform: scale(1.1);
        }
        
        .news-section .card-img-container {
            overflow: hidden;
        }
        
        .news-section .card-body {
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 250px;
        }
        
        .news-section .card-title {
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #0056b3;
            line-height: 1.4;
        }
        
        .news-section .card-text {
            color: #555;
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
        
        .news-section .btn-detail {
            align-self: flex-start;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
        }
        
        /* FAQ section */
        .faq-section .accordion-item {
            border: none;
            margin-bottom: 15px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .faq-section .accordion-button {
            background: linear-gradient(135deg, #0056b3, #00aaff);
            color: white;
            font-weight: 600;
            padding: 20px 25px;
            border-radius: 12px;
            box-shadow: none !important;
        }
        
        .faq-section .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #004494, #0088cc);
        }
        
        .faq-section .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
        
        .faq-section .accordion-body {
            background-color: white;
            padding: 25px;
            line-height: 1.8;
            color: #444;
            font-size: 1.05rem;
        }

        /* Chatbot styling */
        df-messenger {
            --df-messenger-bot-message: #0056b3;
            --df-messenger-button-titlebar-color: #0056b3;
            --df-messenger-chat-background-color: #fafafa;
            --df-messenger-font-color: white;
            --df-messenger-send-icon: #0056b3;
            --df-messenger-user-message: #00aaff;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Banner -->
    <div class="hero-banner">
        <div class="container">
            <h1 class="mb-4">TRA CỨU VI PHẠM GIAO THÔNG</h1>
            <p class="mb-5">Kiểm tra thông tin vi phạm giao thông của phương tiện chỉ với vài bước đơn giản. Hệ thống cung cấp dữ liệu chính xác và cập nhật liên tục.</p>
            <a href="{{ route('lookup') }}" class="btn btn-lookup">
                <i class="fas fa-search me-2"></i> TRA CỨU NGAY
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="section-container statistics-section">
        <h2 class="section-heading">Thống Kê Vi Phạm</h2>
        <div class="row">
            <!-- Row 1: Hai card đầu tiên -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-car me-2"></i> Loại xe vi phạm nhiều nhất
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        @if(isset($mostViolatedVehicleType))
                            <h3 class="stat-value">{{ $mostViolatedVehicleType->type }}</h3>
                            <p class="text-center">Với {{ number_format($mostViolatedVehicleType->violation_count) }} vi phạm</p>
                        @else
                            <p class="text-center">Không có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <i class="fas fa-exclamation-triangle me-2"></i> Top 3 lỗi vi phạm phổ biến
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled top-violations">
                            @forelse($topViolationTypes as $index => $violation)
                                <li>
                                    <div class="violation-type">
                                        <strong>{{ $index + 1 }}. </strong>{{ $violation->violation_type }}
                                    </div>
                                    <span class="violation-count-badge">{{ number_format($violation->count) }}</span>
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
                        <i class="fas fa-chart-bar me-2"></i> Số lượng vi phạm theo tháng năm {{ date('Y') }}
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
    <div class="section-container traffic-section">
        <h2 class="section-heading">Tình Hình Giao Thông</h2>
        <div class="row">
            @forelse($trafficSituations as $situation)
                <div class="col-md-6 mb-3">
                    <div class="traffic-situation-item">
                        <div class="location">{{ $situation->location }}, {{ $situation->city }}</div>
                        <div class="status">{{ $situation->status }}</div>
                        <div class="time">
                            <i class="far fa-clock me-1"></i> Cập nhật: {{ $situation->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-4">
                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                        <p>Không có thông tin tình hình giao thông.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <!-- News Section -->
    <div class="section-container news-section">
        <h2 class="section-heading">Tin Tức Giao Thông</h2>
        <div class="row">
            @foreach($news as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-img-container">
                            <img src="{{ asset('assets/img/' . $item['image']) }}" class="card-img-top" alt="{{ $item['title'] }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item['title'] }}</h5>
                            <p class="card-text">{{ $item['description'] }}</p>
                            <a href="#" class="btn btn-detail">
                                <i class="fas fa-angle-right me-1"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="section-container faq-section">
        <h2 class="section-heading">Câu Hỏi Thường Gặp</h2>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    <i class="fas fa-question-circle me-2"></i> {{ $faq['question'] }}
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
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Gradient cho Chart
            const ctx = document.getElementById('violationsChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(0, 170, 255, 0.8)');
            gradient.addColorStop(1, 'rgba(0, 86, 179, 0.2)');
            
            // Biểu đồ vi phạm theo tháng
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($months) !!},
                    datasets: [{
                        label: 'Số lượng vi phạm',
                        data: {!! json_encode($violationCounts) !!},
                        backgroundColor: gradient,
                        borderColor: '#0056b3',
                        borderWidth: 1,
                        borderRadius: 8,
                        hoverBackgroundColor: '#00aaff',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)',
                            },
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 15,
                            cornerRadius: 8,
                            titleFont: {
                                size: 16,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 14
                            },
                            displayColors: false
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
@endsection

<!-- Chatbot -->
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger intent="WELCOME" chat-title="Hỗ_trợ_người_dùng" agent-id="e9e2ddfe-471d-4b3a-8562-3339780d54d1"
    language-code="vi"></df-messenger>