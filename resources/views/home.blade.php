@extends('layouts.app')

@section('title', 'Trang Chủ - Tra Cứu Vi Phạm Giao Thông')

@section('styles')
    <style>
        .news-section, .traffic-section, .faq-section {
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
    </style>
@endsection

@section('content')
    <!-- Banner -->
    <div class="banner">
        <h1>TRA CỨU VI PHẠM GIAO THÔNG NHANH CHÓNG</h1>
        <p>Kiêm tra thông tin vi phạm giao thông của phương tiện chỉ với vài bước đơn giản.</p>
        <a href="{{ route('lookup') }}" class="btn btn-lookup">Tra cứu ngay</a>
    </div>

    <!-- News Section -->
    <div class="news-section">
        <h2 class="text-center mb-4" style="color: #0056b3;">Tin Tức Giao Thông</h2>
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

    <!-- Traffic Situation Section -->
    <div class="traffic-section">
        <h2 class="text-center mb-4" style="color: #0056b3;">Tình Hình Giao Thông</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($trafficSituations as $situation)
                                <li class="list-group-item">
                                    <strong>{{ $situation['location'] }}:</strong> {{ $situation['status'] }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="faq-section">
        <h2 class="text-center mb-4" style="color: #0056b3;">Câu Hỏi Thường Gặp (FAQ)</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="faq{{ $index }}" data-bs-parent="#faqAccordion">
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
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="Hỗ_trợ_người_dùng"
  agent-id="e9e2ddfe-471d-4b3a-8562-3339780d54d1"
  language-code="vi"
></df-messenger>