<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DashboardStatsService
{
    /**
     * Get total sales for a specific period
     *
     * @param \Carbon\Carbon $startDate
     * @param \Carbon\Carbon|null $endDate
     * @return float
     */
    public function getTotalSales(Carbon $startDate, Carbon $endDate = null): float
    {
        $query = Payment::where('transaction_status', 'settlement')
            ->where('transaction_time', '>=', $startDate);

        if ($endDate) {
            $query->where('transaction_time', '<', $endDate);
        }

        return $query->sum('gross_amount');
    }

    /**
     * Calculate sales growth percentage between two periods
     *
     * @param float $currentPeriodSales
     * @param float $previousPeriodSales
     * @return float
     */
    public function calculateSalesGrowth(float $currentPeriodSales, float $previousPeriodSales): float
    {
        if ($previousPeriodSales <= 0) {
            return $currentPeriodSales > 0 ? 100 : 0;
        }

        return (($currentPeriodSales - $previousPeriodSales) / $previousPeriodSales) * 100;
    }

    /**
     * Get total visitors for a specific period
     *
     * @param \Carbon\Carbon $startDate
     * @param \Carbon\Carbon|null $endDate
     * @return int
     */
    public function getTotalVisitors(Carbon $startDate, Carbon $endDate = null): int
    {
        $query = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.payment_status', 'paid')
            ->where('orders.visit_date', '>=', $startDate);

        if ($endDate) {
            $query->where('orders.visit_date', '<', $endDate);
        }

        return $query->sum('order_items.quantity');
    }

    /**
     * Get count of pending orders
     *
     * @return int
     */
    public function getPendingOrdersCount(): int
    {
        return Order::where('payment_status', 'pending')->count();
    }

    /**
     * Get most popular packages
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getPopularPackages(int $limit = 5): Collection
    {
        return Package::select('packages.id', 'packages.name', 'packages.image', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'packages.id', '=', 'order_items.package_id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.payment_status', 'paid')
            ->groupBy('packages.id', 'packages.name', 'packages.image')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent orders
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getRecentOrders(int $limit = 5): Collection
    {
        return Order::with(['orderItems.package'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get daily sales data for chart
     *
     * @param int $days
     * @return array
     */
    public function getDailySalesChart(int $days = 30): array
    {
        $dailySales = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_price) as total')
            )
            ->where('payment_status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'labels' => $dailySales->pluck('date')->toArray(),
            'data' => $dailySales->pluck('total')->toArray()
        ];
    }

    /**
     * Get package popularity data for pie chart
     *
     * @param int $limit
     * @return array
     */
    public function getPackagePopularityChart(int $limit = 5): array
    {
        $packages = $this->getPopularPackages($limit);

        return [
            'labels' => $packages->pluck('name')->toArray(),
            'data' => $packages->pluck('total_sold')->toArray()
        ];
    }
}
