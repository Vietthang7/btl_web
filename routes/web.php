<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViolationController;
use App\Http\Controllers\Admin\TrafficSituationController;
use App\Http\Controllers\PaymentController;
// Thêm đoạn code sau vào file routes/web.php

// Admin routes
Route::prefix('admin')->group(function () {
    // Auth routes
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    // Protected routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        // Owners CRUD
        Route::get('/owners', [AdminController::class, 'owners'])->name('admin.owners');
        Route::get('/owners/create', [AdminController::class, 'createOwner'])->name('admin.owners.create');
        Route::post('/owners', [AdminController::class, 'storeOwner'])->name('admin.owners.store');
        Route::get('/owners/{id}/edit', [AdminController::class, 'editOwner'])->name('admin.owners.edit');
        Route::put('/owners/{id}', [AdminController::class, 'updateOwner'])->name('admin.owners.update');
        Route::delete('/owners/{id}', [AdminController::class, 'deleteOwner'])->name('admin.owners.delete');

        // Vehicles CRUD
        Route::get('/vehicles', [AdminController::class, 'vehicles'])->name('admin.vehicles');
        Route::get('/vehicles/create', [AdminController::class, 'createVehicle'])->name('admin.vehicles.create');
        Route::post('/vehicles', [AdminController::class, 'storeVehicle'])->name('admin.vehicles.store');
        Route::get('/vehicles/{id}/edit', [AdminController::class, 'editVehicle'])->name('admin.vehicles.edit');
        Route::put('/vehicles/{id}', [AdminController::class, 'updateVehicle'])->name('admin.vehicles.update');
        Route::delete('/vehicles/{id}', [AdminController::class, 'deleteVehicle'])->name('admin.vehicles.delete');

        // Violations CRUD
        Route::get('/violations', [AdminController::class, 'violations'])->name('admin.violations');
        Route::get('/violations/create', [AdminController::class, 'createViolation'])->name('admin.violations.create');
        Route::post('/violations', [AdminController::class, 'storeViolation'])->name('admin.violations.store');
        Route::get('/violations/{id}/edit', [AdminController::class, 'editViolation'])->name('admin.violations.edit');
        Route::put('/violations/{id}', [AdminController::class, 'updateViolation'])->name('admin.violations.update');
        Route::delete('/violations/{id}', [AdminController::class, 'deleteViolation'])->name('admin.violations.delete');

        // Admins CRUD (chỉ có super_admin mới có quyền)
        Route::get('/admins', [AdminController::class, 'admins'])->name('admin.admins');
        Route::get('/admins/create', [AdminController::class, 'createAdmin'])->name('admin.admins.create');
        Route::post('/admins', [AdminController::class, 'storeAdmin'])->name('admin.admins.store');
        Route::get('/admins/{id}/edit', [AdminController::class, 'editAdmin'])->name('admin.admins.edit');
        Route::put('/admins/{id}', [AdminController::class, 'updateAdmin'])->name('admin.admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'deleteAdmin'])->name('admin.admins.delete');

        //Search - sửa lại path và thêm dấu chấm phẩy
        Route::get('/violations/search', [ViolationController::class, 'search'])
            ->name('admin.violations.search');

        Route::resource('traffic-situations', TrafficSituationController::class)->names([
            'index' => 'admin.traffic-situations.index',
            'create' => 'admin.traffic-situations.create',
            'store' => 'admin.traffic-situations.store',
            'show' => 'admin.traffic-situations.show',
            'edit' => 'admin.traffic-situations.edit',
            'update' => 'admin.traffic-situations.update',
            'destroy' => 'admin.traffic-situations.destroy',
        ]);
        Route::put('/violations/{id}/payment-status', [AdminController::class, 'updatePaymentStatus'])
            ->name('admin.violations.payment-status');
        // Routes cho thanh toán
        Route::get('/payment/{id}', [PaymentController::class, 'showPayment'])->name('payment.show');
        Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirmPayment'])->name('payment.confirm');
    });
});