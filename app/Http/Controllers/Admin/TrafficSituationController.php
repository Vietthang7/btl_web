<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrafficSituation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrafficSituationController extends Controller
{
    /**
     * Hiển thị danh sách tình hình giao thông
     */
    public function index()
    {
        $trafficSituations = TrafficSituation::latest()->paginate(10);
        return view('admin.traffic_situations.index', compact('trafficSituations'));
    }

    /**
     * Hiển thị form tạo mới
     */
    public function create()
    {
        return view('admin.traffic_situations.create');
    }

    /**
     * Lưu tình hình giao thông mới
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|string|max:255',
            'status' => 'required|string',
            'city' => 'required|string|max:100',
            'updated_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        TrafficSituation::create([
            'location' => $request->location,
            'status' => $request->status,
            'city' => $request->city,
            'updated_at' => $request->updated_at ?? now(),
        ]);

        return redirect()->route('admin.traffic-situations.index')
            ->with('success', 'Thêm thông tin tình hình giao thông thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit(TrafficSituation $trafficSituation)
    {
        return view('admin.traffic_situations.edit', compact('trafficSituation'));
    }

    /**
     * Cập nhật tình hình giao thông
     */
    public function update(Request $request, TrafficSituation $trafficSituation)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required|string|max:255',
            'status' => 'required|string',
            'city' => 'required|string|max:100',
            'updated_at' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $trafficSituation->update([
            'location' => $request->location,
            'status' => $request->status,
            'city' => $request->city,
            'updated_at' => $request->updated_at ?? now(),
        ]);

        return redirect()->route('admin.traffic-situations.index')
            ->with('success', 'Cập nhật tình hình giao thông thành công!');
    }

    /**
     * Xóa tình hình giao thông
     */
    public function destroy(TrafficSituation $trafficSituation)
    {
        $trafficSituation->delete();

        return redirect()->route('admin.traffic-situations.index')
            ->with('success', 'Xóa tình hình giao thông thành công!');
    }
}