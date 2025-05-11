<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Violation;

class PaymentController extends Controller
{
    /**
     * Hiển thị trang thanh toán với mã QR
     */
    public function showPayment($id)
    {
        $violation = Violation::findOrFail($id);
        
        // Tạo nội dung chuyển khoản
        $paymentInfo = [
            'bankAccount' => '1028038024',
            'bankName' => 'VCB',
            'accountName' => 'Hệ thống tra cứu vi phạm giao thông',
            'amount' => $violation->fine_amount,
            'description' => 'Thanh toan vi pham bien so xe ' . $violation->vehicle->license_plate
        ];
        
        return view('payment.show', compact('violation', 'paymentInfo'));
    }
    
    /**
     * Xác nhận đã thanh toán (sẽ được xử lý bởi admin sau)
     */
    public function confirmPayment($id)
    {
        $violation = Violation::findOrFail($id);
        
        return redirect()->route('lookup.result', ['license_plate' => $violation->vehicle->license_plate])
            ->with('success', 'Yêu cầu xác nhận thanh toán đã được ghi nhận. Trạng thái sẽ được cập nhật sau khi admin xác minh.');
    }
}