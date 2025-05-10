@extends('admin.layouts.app')

@section('title', 'Dashboard - Hệ thống tra cứu vi phạm giao thông')

@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="stats-card stats-card-primary">
                <div class="stats-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="stats-number">{{ $totalOwners }}</div>
                <div class="stats-title">Chủ phương tiện</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card stats-card-success">
                <div class="stats-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stats-number">{{ $totalVehicles }}</div>
                <div class="stats-title">Phương tiện</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card stats-card-danger">
                <div class="stats-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-number">{{ $totalViolations }}</div>
                <div class="stats-title">Vi phạm</div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="stats-card stats-card-warning">
                <div class="stats-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stats-number">{{ $unpaidViolations }}</div>
                <div class="stats-title">Vi phạm chưa nộp phạt</div>
            </div>
        </div>
    </div>
    
    <!-- Charts Row -->
    <div class="row">
        <!-- Violation Types Chart -->
        <div class="col-md-6 mb-4">
            <div class="card-admin">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Thống kê theo loại vi phạm</span>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="violationTypesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Violations -->
        <div class="col-md-6 mb-4">
            <div class="card-admin">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Vi phạm gần đây</span>
                    <a href="{{ route('admin.violations') }}" class="btn btn-sm btn-admin-primary">Xem tất cả</a>
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-admin">
                        <thead>
                            <tr>
                                <th>Biển số xe</th>
                                <th>Ngày vi phạm</th>
                                <th>Loại vi phạm</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Violation::with('vehicle')->orderBy('violation_date', 'desc')->take(5)->get() as $violation)
                            <tr>
                                <td>{{ $violation->vehicle->license_plate }}</td>
                                <td>{{ \Carbon\Carbon::parse($violation->violation_date)->format('d/m/Y') }}</td>
                                <td>{{ $violation->violation_type }}</td>
                                <td>
                                    @if($violation->payment_status == 'Paid')
                                        <span class="badge bg-success">Đã nộp phạt</span>
                                    @else
                                        <span class="badge bg-danger">Chưa nộp phạt</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Violation Types Chart
        var violationTypesData = @json($violationTypes);
        var labels = violationTypesData.map(item => item.violation_type);
        var data = violationTypesData.map(item => item.count);
        
        var ctx = document.getElementById('violationTypesChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#0056b3',
                        '#28a745',
                        '#dc3545',
                        '#ffc107',
                        '#17a2b8',
                        '#6c757d'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });
    });
</script>
@endsection