<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        // الإحصائيات
        $usersCount     = User::count();
        $bookingsCount  = Booking::count();
        $productsCount  = Product::count();
        $ordersCount    = Order::count();
        $reviewsCount   = Review::count();

        // الحجوزات حسب الشهور
        $bookingsByMonth = Booking::selectRaw('MONTH(booking_date) as month, COUNT(*) as count')
            ->groupBy('month')->orderBy('month')
            ->pluck('count', 'month');

        // الطلبات حسب الشهور
        $ordersByMonth = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')->orderBy('month')
            ->pluck('count', 'month');

        return view('admin.dashboard', compact(
            'usersCount', 'bookingsCount', 'productsCount', 'ordersCount', 'reviewsCount',
            'bookingsByMonth', 'ordersByMonth'
        ));
    }
}
