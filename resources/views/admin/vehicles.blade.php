@extends('admin.layouts.app')

@section('title', 'Quản lý phương tiện - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Quản lý phương tiện')

@section('content')
    <div class="card-admin">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Danh sách phương tiện</span>
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-admin-primary">
                <i class="fas fa-plus-circle me-1"></i> Thêm mới
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-admin">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Biển số xe</th>
                            <th>Loại xe</th>
                            <th>Hãng xe</th>
                            <th>Mẫu xe</th>
                            <th>Chủ sở hữu</th>
                            <th>Số vi phạm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ $vehicle->license_plate }}</td>
                            <td>{{ $vehicle->type }}</td>
                            <td>{{ $vehicle->brand }}</td>
                            <td>{{ $vehicle->model }}</td>
                            <td>{{ $vehicle->owner->name }}</td>
                            <td>{{ $vehicle->violations->count() }}</td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-sm btn-admin-primary me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.vehicles.delete', $vehicle->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
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