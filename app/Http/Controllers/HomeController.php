<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = [
            [
                'title' => 'Tai nạn giao thông tại Hà Nội',
                'description' => 'Một vụ tai nạn nghiêm trọng xảy ra vào sáng ngày 21/04/2025 tại ngã tư Kim Mã, khiến 3 người bị thương.',
                'image' => 'tải xuống.jpg',
            ],
            [
                'title' => 'Tăng cường kiểm tra nồng độ cồn',
                'description' => 'Cảnh sát giao thông TP.HCM triển khai chiến dịch kiểm tra nồng độ cồn từ ngày 22/04/2025.',
                'image' => 'tải xuống (2).jpg',
            ],
            [
                'title' => 'Cấm xe tải giờ cao điểm',
                'description' => 'TP. Đà Nẵng áp dụng lệnh cấm xe tải vào giờ cao điểm để giảm ùn tắc từ ngày 23/04/2025.',
                'image' => 'images (1).jpg',
            ],
            [
                'title' => 'Mở rộng tuyến metro tại TP.HCM',
                'description' => 'Dự án metro số 2 tại TP.HCM bắt đầu mở rộng từ ngày 24/04/2025, dự kiến hoàn thành vào năm 2027.',
                'image' => 'images.jpg',
            ],
            [
                'title' => 'Tăng phí gửi xe tại Hà Nội',
                'description' => 'Từ ngày 25/04/2025, phí gửi xe tại các bãi đỗ công cộng ở Hà Nội tăng 10% để hỗ trợ quản lý giao thông.',
                'image' => 'tải xuống (2).jpg',
            ],
            [
                'title' => 'Xây cầu vượt tại Nha Trang',
                'description' => 'Một cây cầu vượt mới sẽ được xây tại Nha Trang để giảm ùn tắc, khởi công ngày 26/04/2025.',
                'image' => 'images (3).jpg',
            ],
            [
                'title' => 'Kiểm tra tải trọng xe tại Hải Phòng',
                'description' => 'Cảnh sát giao thông Hải Phòng tăng cường kiểm tra tải trọng xe từ ngày 27/04/2025 để đảm bảo an toàn.',
                'image' => 'images.jpg',
            ],
            [
                'title' => 'Lắp camera giao thông tại Đà Lạt',
                'description' => 'Đà Lạt triển khai lắp đặt camera giao thông tại các ngã tư lớn từ ngày 28/04/2025.',
                'image' => 'tải xuống (2).jpg',
            ],
            [
                'title' => 'Cải tạo đường cao tốc Bắc - Nam',
                'description' => 'Dự án cải tạo đường cao tốc Bắc - Nam bắt đầu từ ngày 29/04/2025, dự kiến hoàn thành trong 2 năm.',
                'image' => 'tải xuống (1).jpg',
            ],
        ];

        $trafficSituations = [
            ['location' => 'Đường Nguyễn Trãi, Hà Nội', 'status' => 'Ùn tắc nghiêm trọng do tai nạn lúc 7:00 sáng.'],
            ['location' => 'Cầu Sài Gòn, TP.HCM', 'status' => 'Giao thông thông thoáng, không có sự cố.'],
            ['location' => 'Đường Hùng Vương, Đà Nẵng', 'status' => 'Tắc nghẽn nhẹ do công trình sửa đường.'],
        ];

        $faqs = [
            [
                'question' => 'Làm thế nào để tra cứu vi phạm giao thông?',
                'answer' => 'Bạn chỉ cần nhập biển số xe vào ô tra cứu trên trang web, sau đó nhấn nút "Tra cứu". Hệ thống sẽ hiển thị thông tin vi phạm (nếu có) của phương tiện.',
            ],
            [
                'question' => 'Tôi có thể tra cứu vi phạm của xe không phải của mình không?',
                'answer' => 'Bạn có thể tra cứu vi phạm của bất kỳ phương tiện nào, miễn là bạn có thông tin biển số xe. Tuy nhiên, thông tin chi tiết như chủ phương tiện sẽ được bảo mật theo quy định.',
            ],
            [
                'question' => 'Làm sao để nộp phạt vi phạm giao thông?',
                'answer' => 'Sau khi tra cứu, bạn sẽ nhận được thông tin về vi phạm và mức phạt. Bạn có thể nộp phạt trực tiếp tại cơ quan giao thông hoặc qua các cổng thanh toán trực tuyến được liên kết.',
            ],
            [
                'question' => 'Dữ liệu vi phạm có được cập nhật thường xuyên không?',
                'answer' => 'Có, dữ liệu vi phạm được cập nhật hàng ngày từ hệ thống camera giao thông và báo cáo của cảnh sát giao thông trên toàn quốc.',
            ],
        ];

        return view('home', compact('news', 'trafficSituations', 'faqs'));
    }
}