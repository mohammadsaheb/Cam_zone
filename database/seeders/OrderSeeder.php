<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        // مثال على طلب بالدفع عند الاستلام، وحالة قيد التنفيذ
        Order::create([
            'user_id' => 1,
            'total_amount' => 350.00,
            'payment_method' => 'cash_on_delivery',
            'payment_status' => 'pending',
            'order_status' => 'processing',
            'shipping_address' => 'Amman, Jordan',
            'billing_address' => 'Amman, Jordan',
            'tracking_number' => 'TRK123456',
        ]);

        // مثال على طلب دفع ببطاقة فيزا، حالة تم التوصيل والدفع
        Order::create([
            'user_id' => 1,
            'total_amount' => 500.00,
            'payment_method' => 'visa',
            'payment_status' => 'paid',
            'order_status' => 'delivered',
            'shipping_address' => 'Irbid, Jordan',
            'billing_address' => 'Irbid, Jordan',
            'tracking_number' => 'TRK654321',
        ]);

        // مثال على طلب دفع ببطاقة ماستركارد، ملغي
        Order::create([
            'user_id' => 1,
            'total_amount' => 200.00,
            'payment_method' => 'mastercard',
            'payment_status' => 'failed',
            'order_status' => 'cancelled',
            'shipping_address' => 'Zarqa, Jordan',
            'billing_address' => 'Zarqa, Jordan',
            'tracking_number' => 'TRK987654',
        ]);
    }
}
