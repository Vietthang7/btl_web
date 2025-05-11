@extends('admin.layouts.app')

@section('title', 'Quản lý chủ phương tiện - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Quản lý chủ phương tiện')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Danh sách chủ phương tiện</span>
            <a href="{{ route('admin.owners.create') }}" class="btn btn-admin-primary">
                <i class="fas fa-plus-circle me-1"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Phương tiện</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($owners as $owner)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->phone }}</td>
                            <td>{{ $owner->address }}</td>
                            <td>{{ $owner->vehicles->count() }}</td>
                            <td>
                                <a href="{{ route('admin.owners.edit', $owner->id) }}" class="btn btn-sm btn-admin-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.owners.delete', $owner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-admin-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection