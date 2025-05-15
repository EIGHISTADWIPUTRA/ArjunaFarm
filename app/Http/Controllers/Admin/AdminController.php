<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatsService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * The dashboard stats service instance.
     *
     * @var \App\Services\DashboardStatsService
     */
    protected $statsService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\DashboardStatsService $statsService
     */
    public function __construct(DashboardStatsService $statsService)
    {
        $this->middleware(['auth', 'admin']);
        $this->statsService = $statsService;
    }

    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Define time periods
        $currentMonth = Carbon::now()->startOfMonth();
        $previousMonth = Carbon::now()->subMonth()->startOfMonth();

        // Get statistics using the service
        $totalSales = $this->statsService->getTotalSales($currentMonth);
        $previousMonthSales = $this->statsService->getTotalSales($previousMonth, $currentMonth);
        $salesGrowth = $this->statsService->calculateSalesGrowth($totalSales, $previousMonthSales);

        $totalVisitors = $this->statsService->getTotalVisitors($currentMonth);
        $pendingOrders = $this->statsService->getPendingOrdersCount();
        $popularPackages = $this->statsService->getPopularPackages(5);
        $recentOrders = $this->statsService->getRecentOrders(5);

        // Get chart data
        $salesChart = $this->statsService->getDailySalesChart(30);
        $packageChart = $this->statsService->getPackagePopularityChart(5);

        // Return data to view
        return view('admin.dashboard', compact(
            'totalSales',
            'previousMonthSales',
            'salesGrowth',
            'totalVisitors',
            'pendingOrders',
            'popularPackages',
            'recentOrders',
            'salesChart',
            'packageChart'
        ));
    }
}
