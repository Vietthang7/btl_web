@extends('admin.layouts.app')

@section('title', 'Quản lý Tình Hình Giao Thông')
@section('page-title', 'Quản lý Tình Hình Giao Thông')
@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('admin.traffic-situations.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Thêm mới
    </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif

    <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Danh sách tình hình giao thông</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
        <tr>
          <th>STT</th>
          <th>Địa điểm</th>
          <th>Thành phố</th>
          <th>Tình trạng</th>
          <th>Cập nhật lúc</th>
          <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($trafficSituations as $situation)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $situation->location }}</td>
        <td>{{ $situation->city }}</td>
        <td>{{ $situation->status }}</td>
        <td>{{ $situation->updated_at->format('d/m/Y H:i') }}</td>
        <td>
        <div class="d-flex">
        <a href="{{ route('admin.traffic-situations.edit', $situation) }}"
        class="btn btn-sm btn-primary me-2">
        <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('admin.traffic-situations.destroy', $situation) }}" method="POST"
        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
          <i class="fas fa-trash"></i>
        </button>
        </form>
        </div>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center">Không có dữ liệu</td>
      </tr>
      @endforelse
        </tbody>
      </table>
      </div>

      <div class="mt-3">
      {{ $trafficSituations->links() }}
      </div>
    </div>
    </div>
  </div>
@endsection