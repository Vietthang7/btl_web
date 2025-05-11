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
     * Hiển thị trang thanh toán cho tất cả vi phạm
     */
    public function showPaymentAll($ids)
    {
        $idArray = explode(',', $ids);
        $violations = Violation::whereIn('id', $idArray)->get();
        
        if ($violations->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy vi phạm nào cần thanh toán');
        }
        
        // Tính tổng số tiền cần thanh toán
        $totalAmount = $violations->sum('fine_amount');
        
        // Lấy biển số xe từ vi phạm đầu tiên
        $licensePlate = $violations->first()->vehicle->license_plate;
        
        // Tạo nội dung chuyển khoản
        $paymentInfo = [
            'bankAccount' => '1028038024',
            'bankName' => 'VCB',
            'accountName' => 'Hệ thống tra cứu vi phạm giao thông',
            'amount' => $totalAmount,
            'description' => 'Thanh toan vi pham bien so xe ' . $licensePlate
        ];
        
        return view('payment.show-all', compact('violations', 'paymentInfo', 'ids'));
    }
    
    /**
     * Xác nhận đã thanh toán (sẽ được xử lý bởi admin sau)
     */
    public function confirmPayment($id)
    {
        $violation = Violation::findOrFail($id);
        
        // Chuyển hướng về trang chủ với thông báo
        return redirect()->route('home')
            ->with('success', 'Cảm ơn bạn đã thanh toán! Hệ thống sẽ kiểm tra và cập nhật trạng thái trong vòng 24 giờ tới.');
    }
    
    /**
     * Xác nhận đã thanh toán tất cả vi phạm
     */
    public function confirmPaymentAll(Request $request)
    {
        $ids = explode(',', $request->ids);
        $violations = Violation::whereIn('id', $ids)->get();
        
        if ($violations->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy vi phạm nào');
        }
        
        // Chuyển hướng về trang chủ với thông báo
        return redirect()->route('home')
            ->with('success', 'Cảm ơn bạn đã thanh toán tất cả các vi phạm! Hệ thống sẽ kiểm tra và cập nhật trạng thái trong vòng 24 giờ tới.');
    }
}