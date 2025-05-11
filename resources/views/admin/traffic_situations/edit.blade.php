@extends('admin.layouts.app')

@section('title', 'Chỉnh Sửa Tình Hình Giao Thông')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh Sửa Tình Hình Giao Thông</h1>
            <a href="{{ route('admin.traffic-situations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Thông tin tình hình giao thông</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.traffic-situations.update', $trafficSituation) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group row">
                        <label for="location" class="col-sm-2 col-form-label">Địa điểm <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $trafficSituation->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">Thành phố <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $trafficSituation->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Tình trạng <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('status') is-invalid @enderror" id="status" name="status" rows="3" required>{{ old('status', $trafficSituation->status) }}</textarea>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="updated_at" class="col-sm-2 col-form-label">Thời gian cập nhật</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control @error('updated_at') is-invalid @enderror" id="updated_at" name="updated_at" 
                                   value="{{ old('updated_at') ?? $trafficSituation->updated_at->format('Y-m-d\TH:i') }}">
                            @error('updated_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Để trống nếu muốn sử dụng thời gian hiện tại</small>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Cập nhật
                            </button>
                            <a href="{{ route('admin.traffic-situations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection