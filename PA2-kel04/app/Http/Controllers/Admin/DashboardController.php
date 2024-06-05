<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total penjualan
        $total_penjualan = Order::select(DB::raw("CAST(SUM(grand_total) as int) as total_penjualan"))
            ->groupBy(DB::raw("DAY(created_at)"))
            ->pluck('total_penjualan');

        // Menghitung hari
        $hari = Order::select(DB::raw("DAYNAME(created_at) as hari"))
            ->groupBy(DB::raw("DAYNAME(created_at)"))
            ->pluck('hari');

        return view('admin.dashboard', compact('total_penjualan', 'hari'));
    }
}
