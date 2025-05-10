@extends('admin.layouts.app')

@section('title', 'Quản lý Admin - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Quản lý Admin')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Danh sách Admin</span>
            <a href="{{ route('admin.admins.create') }}" class="btn btn-admin-primary">
                <i class="fas fa-plus-circle me-1"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @if($admin->role == 'super_admin')
                                    <span class="badge bg-danger">Super Admin</span>
                                @else
                                    <span class="badge bg-primary">Admin</span>
                                @endif
                            </td>
                            <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-admin-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($admin->id !== Auth::guard('admin')->id())
                                    <form action="{{ route('admin.admins.delete', $admin->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-admin-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection