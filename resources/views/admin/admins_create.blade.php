@extends('admin.layouts.app')

@section('title', 'Thêm Admin - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Thêm Admin')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Thêm Admin mới</span>
            <a href="{{ route('admin.admins') }}" class="btn btn-sm btn-admin-primary">
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

            <form action="{{ route('admin.admins.store') }}" method="POST" class="form-admin">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
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