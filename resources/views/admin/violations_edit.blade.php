@extends('admin.layouts.app')

@section('title', 'Sửa vi phạm - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Sửa vi phạm')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Sửa thông tin vi phạm</span>
            <a href="{{ route('admin.violations') }}" class="btn btn-sm btn-admin-primary">
                <i class="fas fa-arrow-left me-1"></i> Quay lại
            </a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.violations.update', $violation->id) }}" method="POST" class="form-admin">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="vehicle_id" class="form-label">Phương tiện</label>
                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                            <option value="">Chọn phương tiện</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $violation->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->license_plate }} - {{ $vehicle->owner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="violation_date" class="form-label">Ngày vi phạm</label>
                        <input type="date" class="form-control" id="violation_date" name="violation_date" value="{{ old('violation_date', date('Y-m-d', strtotime($violation->violation_date))) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="violation_type" class="form-label">Loại vi phạm</label>
                        <select class="form-control" id="violation_type" name="violation_type" required>
                            <option value="">Chọn loại vi phạm</option>
                            <option value="Vượt đèn đỏ" {{ old('violation_type', $violation->violation_type) == 'Vượt đèn đỏ' ? 'selected' : '' }}>Vượt đèn đỏ</option>
                            <option value="Chạy quá tốc độ" {{ old('violation_type', $violation->violation_type) == 'Chạy quá tốc độ' ? 'selected' : '' }}>Chạy quá tốc độ</option>
                            <option value="Không đội mũ bảo hiểm" {{ old('violation_type', $violation->violation_type) == 'Không đội mũ bảo hiểm' ? 'selected' : '' }}>Không đội mũ bảo hiểm</option>
                            <option value="Đỗ xe sai quy định" {{ old('violation_type', $violation->violation_type) == 'Đỗ xe sai quy định' ? 'selected' : '' }}>Đỗ xe sai quy định</option>
                            <option value="Lái xe khi đã sử dụng rượu bia" {{ old('violation_type', $violation->violation_type) == 'Lái xe khi đã sử dụng rượu bia' ? 'selected' : '' }}>Lái xe khi đã sử dụng rượu bia</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="fine_amount" class="form-label">Số tiền phạt (VNĐ)</label>
                        <input type="number" class="form-control" id="fine_amount" name="fine_amount" value="{{ old('fine_amount', $violation->fine_amount) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Địa điểm</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $violation->location) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="payment_status" class="form-label">Trạng thái thanh toán</label>
                        <select class="form-control" id="payment_status" name="payment_status" required>
                            <option value="Unpaid" {{ old('payment_status', $violation->payment_status) == 'Unpaid' ? 'selected' : '' }}>Chưa nộp phạt</option>
                            <option value="Paid" {{ old('payment_status', $violation->payment_status) == 'Paid' ? 'selected' : '' }}>Đã nộp phạt</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3 payment-method-div" style="display: {{ old('payment_status', $violation->payment_status) == 'Paid' ? 'block' : 'none' }};">
                        <label for="payment_method" class="form-label">Phương thức thanh toán</label>
                        <select class="form-control" id="payment_method" name="payment_method" {{ $violation->payment_status == 'Paid' ? 'required' : '' }}>
                            <option value="">Chọn phương thức thanh toán</option>
                            <option value="Online" {{ old('payment_method', $violation->payment_method) == 'Online' ? 'selected' : '' }}>Thanh toán online</option>
                            <option value="Offline" {{ old('payment_method', $violation->payment_method) == 'Offline' ? 'selected' : '' }}>Thanh toán trực tiếp</option>
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-success">
                            <i class="fas fa-save me-1"></i> Cập nhật
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentStatusSelect = document.getElementById('payment_status');
        const paymentMethodDiv = document.querySelector('.payment-method-div');
        const paymentMethodSelect = document.getElementById('payment_method');
        
        paymentStatusSelect.addEventListener('change', function() {
            if (this.value === 'Paid') {
                paymentMethodDiv.style.display = 'block';
                paymentMethodSelect.setAttribute('required', 'required');
            } else {
                paymentMethodDiv.style.display = 'none';
                paymentMethodSelect.removeAttribute('required');
            }
        });
    });
</script>
@endsection