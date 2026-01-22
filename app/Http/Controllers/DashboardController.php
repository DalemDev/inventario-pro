<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\AlertService;

class DashboardController extends Controller
{
    public function index(AlertService $alertService)
    {
        return view('dashboard', [
            'totalProducts' => Product::count(),
            'lowStockProducts' => Product::lowStock()->orderBy('current_stock')->get()->count(),
            'alerts' => $alertService->alerts()
        ]);
    }
}
