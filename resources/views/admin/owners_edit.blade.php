@extends('admin.layouts.app')

@section('title', 'Sửa chủ phương tiện - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Sửa chủ phương tiện')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Sửa thông tin chủ phương tiện</span>
            <a href="{{ route('admin.owners') }}" class="btn btn-sm btn-admin-primary">
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

            <form action="{{ route('admin.owners.update', $owner->id) }}" method="POST" class="form-admin">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $owner->name) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $owner->email) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $owner->phone) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $owner->address) }}" required>
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