@extends('admin.layouts.app')

@section('title', 'Thêm phương tiện - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Thêm phương tiện')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Thêm phương tiện mới</span>
            <a href="{{ route('admin.vehicles') }}" class="btn btn-sm btn-admin-primary">
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

            <form action="{{ route('admin.vehicles.store') }}" method="POST" class="form-admin">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="license_plate" class="form-label">Biển số xe</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ old('license_plate') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Loại xe</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Chọn loại xe</option>
                            <option value="Car" {{ old('type') == 'Car' ? 'selected' : '' }}>Ô tô</option>
                            <option value="Motorcycle" {{ old('type') == 'Motorcycle' ? 'selected' : '' }}>Xe máy</option>
                            <option value="Truck" {{ old('type') == 'Truck' ? 'selected' : '' }}>Xe tải</option>
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="brand" class="form-label">Hãng xe</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="model" class="form-label">Mẫu xe</label>
                        <input type="text" class="form-control" id="model" name="model" value="{{ old('model') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="owner_id" class="form-label">Chủ sở hữu</label>
                        <select class="form-control" id="owner_id" name="owner_id" required>
                            <option value="">Chọn chủ sở hữu</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }} ({{ $owner->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-admin-success">
                            <i class="fas fa-save me-1"></i> Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection