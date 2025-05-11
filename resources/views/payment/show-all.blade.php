@extends('layouts.app')

@section('title', 'Thanh toán tất cả vi phạm')

@section('styles')
  <style>
    .payment-container {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      background-color: white;
    }

    .payment-header {
      text-align: center;
      margin-bottom: 30px;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }

    .payment-qr {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }

    .payment-info {
      border: 1px solid #0056b3;
      border-radius: 5px;
      padding: 20px;
      margin: 20px 0;
      background-color: #f8f9fa;
      height: 100%; /* Đảm bảo các khối có chiều cao bằng nhau */
    }

    .payment-info table {
      width: 100%;
    }

    .payment-info td {
      padding: 8px 5px;
    }

    .payment-info tr td:first-child {
      font-weight: bold;
      width: 40%;
    }

    .payment-info tr td:last-child {
      font-family: monospace;
      font-size: 16px;
    }

    .payment-note {
      padding: 15px;
      border-left: 3px solid #0056b3;
      margin-bottom: 20px;
      background-color: #f0f8ff;
    }

    .payment-buttons {
      text-align: center;
      margin-top: 30px;
    }

    .payment-buttons .btn {
      margin: 0 10px;
    }

    .violation-list {
      margin-top: 20px;
    }

    .violation-list .card {
      margin-bottom: 15px;
    }

    .violation-list .card-header {
      font-weight: bold;
      background-color: #eef2f5;
    }
    
    /* Thêm style để cân bằng khối thông tin */
    .info-row {
      display: flex;
      flex-wrap: wrap;
    }
    
    .info-col {
      display: flex;
      flex-direction: column;
    }
    
    /* Chỉ hiển thị một trong hai cách tạo QR */
    #qr-generated {
      display: none;
    }
  </style>
@endsection

@section('content')
<div class="container">
  <div class="payment-container">
    <div class="payment-header mt-4">
      <h2>Thanh toán tất cả vi phạm</h2>
      <p class="text-muted">Biển số xe: {{ $violations->first()->vehicle->license_plate }}</p>
    </div>

    <!-- Danh sách vi phạm -->
    <div class="violation-list">
      <h4>Danh sách vi phạm ({{ $violations->count() }})</h4>
      @foreach($violations as $violation)
      <div class="card">
        <div class="card-header">
          Vi phạm ngày {{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <p><strong>Loại vi phạm:</strong> {{ $violation->violation_type }}</p>
              <p><strong>Địa điểm:</strong> {{ $violation->location }}</p>
            </div>
            <div class="col-md-4 text-end">
              <p><strong>Số tiền:</strong> <span class="text-danger">{{ number_format($violation->fine_amount) }} VNĐ</span></p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="row info-row">
      <div class="col-md-6 info-col">
        <div class="payment-info">
          <h4>Thông tin tổng hợp</h4>
          <table>
            <tr>
              <td>Số lượng vi phạm:</td>
              <td>{{ $violations->count() }}</td>
            </tr>
            <tr>
              <td>Tổng số tiền phạt:</td>
              <td class="text-danger fw-bold">{{ number_format($paymentInfo['amount']) }} VNĐ</td>
            </tr>
            <!-- Thêm hàng trống để cân bằng với khối bên phải -->
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr><td colspan="2">&nbsp;</td></tr>
          </table>
        </div>
      </div>

      <div class="col-md-6 info-col">
        <div class="payment-info">
          <h4>Thông tin thanh toán</h4>
          <table>
            <tr>
              <td>Ngân hàng:</td>
              <td>{{ $paymentInfo['bankName'] }}</td>
            </tr>
            <tr>
              <td>Số tài khoản:</td>
              <td>{{ $paymentInfo['bankAccount'] }}</td>
            </tr>
            <tr>
              <td>Chủ tài khoản:</td>
              <td>{{ $paymentInfo['accountName'] }}</td>
            </tr>
            <tr>
              <td>Nội dung chuyển khoản:</td>
              <td>{{ $paymentInfo['description'] }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="payment-qr text-center">
      <div>
        <h4 class="mb-3">Quét mã QR để thanh toán</h4>
        <div>
          <!-- Sử dụng API của VietQR để tạo mã QR -->
          <img src="https://img.vietqr.io/image/VCB-{{ $paymentInfo['bankAccount'] }}-compact2.png?amount={{ $paymentInfo['amount'] }}&addInfo={{ urlencode($paymentInfo['description']) }}&accountName={{ urlencode($paymentInfo['accountName']) }}"
            alt="Mã QR thanh toán" id="qr-image"
            style="width: 440px; height: auto; border: 1px solid #ddd; padding: 10px; background-color: white; margin: 0 auto;">
          
          <!-- Div dự phòng nếu API không hoạt động -->
          <div id="qr-generated" style="width: 440px; height: 440px; border: 1px solid #ddd; padding: 10px; background-color: white; margin: 0 auto;"></div>
        </div>
        <p class="mt-2">Hoặc sử dụng app ngân hàng quét mã QR trên</p>
      </div>
    </div>

    <div class="payment-note">
      <h5>Lưu ý:</h5>
      <ul>
        <li>Vui lòng chuyển khoản đúng số tiền và nội dung chuyển khoản như thông tin trên.</li>
        <li>Sau khi thanh toán thành công, vui lòng nhấn "Đã thanh toán" để hệ thống ghi nhận.</li>
        <li>Trạng thái vi phạm sẽ được cập nhật trong vòng 24 giờ sau khi admin xác nhận.</li>
      </ul>
    </div>

    <div class="payment-buttons">
      <form action="{{ route('payment.confirm-all') }}" method="POST">
        @csrf
        <input type="hidden" name="ids" value="{{ $ids }}">
        <button type="submit" class="btn btn-primary">Đã thanh toán</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
      </form>
    </div>
  </div>
</div>

<!-- Thêm thư viện QR Code JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
  // Tạo QR code khi trang đã load - chỉ hiển thị nếu ảnh từ API không tải được
  document.addEventListener('DOMContentLoaded', function() {
    const qrImage = document.getElementById('qr-image');
    const qrGenerated = document.getElementById('qr-generated');
    
    // Nếu ảnh không tải được, hiển thị QR code tạo bởi thư viện
    qrImage.onerror = function() {
      qrImage.style.display = 'none';
      qrGenerated.style.display = 'block';
      
      // Tạo nội dung chuỗi QR
      const bankCode = "VCB";
      const accountNumber = "{{ $paymentInfo['bankAccount'] }}";
      const amount = "{{ $paymentInfo['amount'] }}";
      const description = "{{ $paymentInfo['description'] }}";
      
      // Format theo chuẩn ngân hàng
      const qrContent = `${bankCode}|${accountNumber}|${amount}|${description}`;
      
      new QRCode(qrGenerated, {
        text: qrContent,
        width: 220,
        height: 220,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      });
    };
  });
</script>
@endsection