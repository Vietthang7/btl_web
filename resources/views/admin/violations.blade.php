@extends('admin.layouts.app')

@section('title', 'Quản lý vi phạm - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Quản lý vi phạm')

@section('content')
  <div class="card-admin">
    <div class="row mb-3">
    <div class="col-md-6">
      <div class="input-group">
      <span class="input-group-text"><i class="fas fa-search"></i></span>
      <input type="text" id="license-plate-search" class="form-control" placeholder="Tìm kiếm theo biển số xe...">
      </div>
    </div>
    </div>

    <div class="card-header d-flex justify-content-between align-items-center">
    <span>Danh sách vi phạm</span>
    <a href="{{ route('admin.violations.create') }}" class="btn btn-admin-primary">
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
        <th>Chủ phương tiện</th>
        <th>Ngày vi phạm</th>
        <th>Loại vi phạm</th>
        <th>Tiền phạt</th>
        <th>Trạng thái</th>
        <th>Thao tác</th>
        </tr>
      </thead>
      <tbody id="violations-table-body">
        @foreach($violations as $violation)
      <tr>
      <td>{{ $violation->id }}</td>
      <td>{{ $violation->vehicle->license_plate }}</td>
      <td>{{ $violation->vehicle->owner->name }}</td>
      <td>{{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}</td>
      <td>{{ $violation->violation_type }}</td>
      <td>{{ number_format($violation->fine_amount) }} VNĐ</td>
      <td>
        @if($violation->payment_status == 'Paid')
      <span class="badge bg-success">Đã nộp phạt</span>
      @else
      <span class="badge bg-danger">Chưa nộp phạt</span>
      @endif
      </td>
      <td>
        <a href="{{ route('admin.violations.edit', $violation->id) }}" class="btn btn-sm btn-admin-primary me-1">
        <i class="fas fa-edit"></i>
        </a>
        <form action="{{ route('admin.violations.delete', $violation->id) }}" method="POST" class="d-inline"
        onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
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

@section('scripts')
  <script>
    $(document).ready(function () {
    // Xử lý tìm kiếm realtime khi nhập
    $('#license-plate-search').on('keyup', function () {
      var searchTerm = $(this).val();
      searchViolations(searchTerm);
    });

    function searchViolations(searchTerm) {
      console.log('searchViolations function called with searchTerm:', searchTerm); // Debug log
      $.ajax({
      url: "/admin/violations/search",  // URL trực tiếp để đảm bảo không có lỗi
      method: 'GET',
      data: {
      search: searchTerm
      // _token: $('meta[name="csrf-token"]').attr('content') // Thêm CSRF token
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        // Xóa nội dung hiện tại của bảng
        $('#violations-table-body').empty();

        // Nếu không có kết quả
        if (response.violations.length === 0) {
        $('#violations-table-body').append('<tr><td colspan="8" class="text-center">Không tìm thấy kết quả phù hợp</td></tr>');
        return;
        }

        // Thêm các kết quả mới vào bảng
        $.each(response.violations, function (index, violation) {
        var paymentStatus = violation.payment_status === 'Paid' ?
          '<span class="badge bg-success">Đã nộp phạt</span>' :
          '<span class="badge bg-danger">Chưa nộp phạt</span>';

        // Format date
        var violationDate = new Date(violation.violation_date);
        var day = String(violationDate.getDate()).padStart(2, '0');
        var month = String(violationDate.getMonth() + 1).padStart(2, '0');
        var year = violationDate.getFullYear();
        var formattedDate = day + '/' + month + '/' + year;

        // Format number
        var formattedAmount = new Intl.NumberFormat('vi-VN').format(violation.fine_amount);

        var row = `
          <tr>
          <td>${violation.id}</td>
          <td>${violation.vehicle.license_plate}</td>
          <td>${violation.vehicle.owner.name}</td>
          <td>${formattedDate}</td>
          <td>${violation.violation_type}</td>
          <td>${formattedAmount} VNĐ</td>
          <td>${paymentStatus}</td>
          <td>
            <a href="/admin/violations/${violation.id}/edit" class="btn btn-sm btn-admin-primary me-1">
            <i class="fas fa-edit"></i>
            </a>
            <form action="/admin/violations/${violation.id}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-sm btn-admin-danger">
              <i class="fas fa-trash-alt"></i>
            </button>
            </form>
          </td>
          </tr>
        `;

        $('#violations-table-body').append(row);
        });
      },
      error: function (error) {
        console.error('Error searching violations:', error);
      }
      });
    }
    });
  </script>
@endsection