@extends('admin.layouts.app')

@section('title', 'Sửa Admin - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Sửa Admin')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Sửa thông tin Admin</span>
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

            <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST" class="form-admin">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Vai trò</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="admin" {{ old('role', $admin->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ old('role', $admin->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
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