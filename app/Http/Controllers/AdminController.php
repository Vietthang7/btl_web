<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Owner;
use App\Models\Vehicle;
use App\Models\Violation;
use App\Models\Admin;

class AdminController extends Controller
{
    // Hiển thị trang đăng nhập admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Xử lý đăng nhập admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    // Đăng xuất admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login');
    }

    // Hiển thị dashboard
    public function dashboard()
    {
        $totalOwners = Owner::count();
        $totalVehicles = Vehicle::count();
        $totalViolations = Violation::count();
        $unpaidViolations = Violation::where('payment_status', 'Unpaid')->count();
        
        // Thống kê vi phạm theo loại
        $violationTypes = Violation::selectRaw('violation_type, count(*) as count')
            ->groupBy('violation_type')
            ->get();
            
        return view('admin.dashboard', compact('totalOwners', 'totalVehicles', 'totalViolations', 'unpaidViolations', 'violationTypes'));
    }

    // Quản lý chủ phương tiện
    public function owners()
    {
        $owners = Owner::with('vehicles')->get();
        return view('admin.owners', compact('owners'));
    }

    public function createOwner()
    {
        return view('admin.owners_create');
    }

    public function storeOwner(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        Owner::create($validated);
        return redirect()->route('admin.owners')->with('success', 'Thêm chủ phương tiện thành công.');
    }

    public function editOwner($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.owners_edit', compact('owner'));
    }

    public function updateOwner(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email,'.$id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        $owner->update($validated);
        return redirect()->route('admin.owners')->with('success', 'Cập nhật chủ phương tiện thành công.');
    }

    public function deleteOwner($id)
    {
        $owner = Owner::findOrFail($id);
        $owner->delete();
        return redirect()->route('admin.owners')->with('success', 'Xóa chủ phương tiện thành công.');
    }

    // Quản lý phương tiện
    public function vehicles()
    {
        $vehicles = Vehicle::with('owner')->get();
        return view('admin.vehicles', compact('vehicles'));
    }

    public function createVehicle()
    {
        $owners = Owner::all();
        return view('admin.vehicles_create', compact('owners'));
    }

    public function storeVehicle(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:20|unique:vehicles',
            'type' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'owner_id' => 'required|exists:owners,id',
        ]);

        Vehicle::create($validated);
        return redirect()->route('admin.vehicles')->with('success', 'Thêm phương tiện thành công.');
    }

    public function editVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $owners = Owner::all();
        return view('admin.vehicles_edit', compact('vehicle', 'owners'));
    }

    public function updateVehicle(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        $validated = $request->validate([
            'license_plate' => 'required|string|max:20|unique:vehicles,license_plate,'.$id,
            'type' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'owner_id' => 'required|exists:owners,id',
        ]);

        $vehicle->update($validated);
        return redirect()->route('admin.vehicles')->with('success', 'Cập nhật phương tiện thành công.');
    }

    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect()->route('admin.vehicles')->with('success', 'Xóa phương tiện thành công.');
    }

    // Quản lý vi phạm
    public function violations()
    {
        $violations = Violation::with('vehicle.owner')->get();
        return view('admin.violations', compact('violations'));
    }

    public function createViolation()
    {
        $vehicles = Vehicle::with('owner')->get();
        return view('admin.violations_create', compact('vehicles'));
    }

    public function storeViolation(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'violation_date' => 'required|date',
            'violation_type' => 'required|string|max:255',
            'fine_amount' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'payment_status' => 'required|in:Paid,Unpaid',
            'payment_method' => 'nullable|string|max:50',
        ]);

        Violation::create($validated);
        return redirect()->route('admin.violations')->with('success', 'Thêm vi phạm thành công.');
    }

    public function editViolation($id)
    {
        $violation = Violation::findOrFail($id);
        $vehicles = Vehicle::with('owner')->get();
        return view('admin.violations_edit', compact('violation', 'vehicles'));
    }

    public function updateViolation(Request $request, $id)
    {
        $violation = Violation::findOrFail($id);
        
        $validated = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'violation_date' => 'required|date',
            'violation_type' => 'required|string|max:255',
            'fine_amount' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'payment_status' => 'required|in:Paid,Unpaid',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $violation->update($validated);
        return redirect()->route('admin.violations')->with('success', 'Cập nhật vi phạm thành công.');
    }

    public function deleteViolation($id)
    {
        $violation = Violation::findOrFail($id);
        $violation->delete();
        return redirect()->route('admin.violations')->with('success', 'Xóa vi phạm thành công.');
    }

    // Quản lý tài khoản admin
    public function admins()
    {
        // Chỉ super_admin mới có thể xem danh sách admin
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        
        $admins = Admin::all();
        return view('admin.admins', compact('admins'));
    }

    public function createAdmin()
    {
        // Chỉ super_admin mới có thể tạo admin mới
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        
        return view('admin.admins_create');
    }

    public function storeAdmin(Request $request)
    {
        // Chỉ super_admin mới có thể tạo admin mới
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        
        Admin::create($validated);
        return redirect()->route('admin.admins')->with('success', 'Thêm admin thành công.');
    }

    public function editAdmin($id)
    {
        // Chỉ super_admin mới có thể sửa admin
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        
        $admin = Admin::findOrFail($id);
        return view('admin.admins_edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        // Chỉ super_admin mới có thể sửa admin
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }
        
        $admin = Admin::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $admin->update($validated);
        return redirect()->route('admin.admins')->with('success', 'Cập nhật admin thành công.');
    }

    public function deleteAdmin($id)
    {
        // Chỉ super_admin mới có thể xóa admin
        if (Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Bạn không có quyền thực hiện hành động này.');
        }
        
        $admin = Admin::findOrFail($id);
        
        // Không thể xóa chính mình
        if ($admin->id === Auth::guard('admin')->id()) {
            return redirect()->route('admin.admins')->with('error', 'Bạn không thể xóa tài khoản của chính mình.');
        }
        
        $admin->delete();
        return redirect()->route('admin.admins')->with('success', 'Xóa admin thành công.');
    }
}