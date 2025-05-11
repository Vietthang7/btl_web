@extends('layouts.app')

@section('title', 'Thanh toán vi phạm')

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
    #qrcode {
        margin: 0 auto;
        width: 240px;
        padding: 10px;
        border: 1px solid #ddd;
        background-color: white;
    }
    .payment-info {
        border: 1px solid #0056b3;
        border-radius: 5px;
        padding: 20px;
        margin: 20px 0;
        background-color: #f8f9fa;
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
</style>
@endsection

@section('content')
<div class="container">
    <div class="payment-container">
        <div class="payment-header">
            <h2>Thanh toán vi phạm giao thông</h2>
            <p class="text-muted">Biển số xe: {{ $violation->vehicle->license_plate }}</p>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="payment-info">
                    <h4>Thông tin vi phạm</h4>
                    <table>
                        <tr>
                            <td>Ngày vi phạm:</td>
                            <td>{{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Loại vi phạm:</td>
                            <td>{{ $violation->violation_type }}</td>
                        </tr>
                        <tr>
                            <td>Địa điểm:</td>
                            <td>{{ $violation->location }}</td>
                        </tr>
                        <tr>
                            <td>Số tiền phạt:</td>
                            <td class="text-danger fw-bold">{{ number_format($violation->fine_amount) }} VNĐ</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-6">
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
                            <td>Số tiền:</td>
                            <td class="text-danger fw-bold">{{ number_format($violation->fine_amount) }} VNĐ</td>
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
                <!-- Thay thế thẻ img bằng div để chứa mã QR -->
                <div id="qrcode"></div>
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
            <form action="{{ route('payment.confirm', $violation->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Đã thanh toán</button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<!-- Thêm thư viện QR Code JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
    // Tạo QR code khi trang đã load
    document.addEventListener('DOMContentLoaded', function() {
        // Tạo nội dung chuỗi QR theo định dạng VietQR
        const bankCode = "VCB"; // Mã ngân hàng VietComBank
        const accountNumber = "{{ $paymentInfo['bankAccount'] }}";
        const amount = "{{ $violation->fine_amount }}";
        const description = "{{ $paymentInfo['description'] }}";
        
        // Format theo chuẩn VNPay QR: bankCode|accountNumber|amount|description
        const qrContent = `${bankCode}|${accountNumber}|${amount}|${description}`;
        
        new QRCode(document.getElementById("qrcode"), {
            text: qrContent,
            width: 240,
            height: 240,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });
</script>