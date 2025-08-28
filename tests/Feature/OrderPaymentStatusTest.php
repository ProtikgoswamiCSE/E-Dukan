<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderPaymentStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_status_shows_payment_complete_when_delivered()
    {
        $order = Order::factory()->create([
            'status' => 'delivered',
            'payment_status' => 'pending'
        ]);

        $this->assertEquals('Payment Complete', $order->payment_status_display);
        $this->assertEquals('success', $order->payment_status_badge);
    }

    public function test_payment_status_shows_order_cancelled_when_cancelled()
    {
        $order = Order::factory()->create([
            'status' => 'cancelled',
            'payment_status' => 'pending'
        ]);

        $this->assertEquals('Order Cancelled', $order->payment_status_display);
        $this->assertEquals('danger', $order->payment_status_badge);
    }

    public function test_payment_status_shows_pending_when_not_delivered_or_cancelled()
    {
        $order = Order::factory()->create([
            'status' => 'processing',
            'payment_status' => 'pending'
        ]);

        $this->assertEquals('Pending', $order->payment_status_display);
        $this->assertEquals('warning', $order->payment_status_badge);
    }

    public function test_payment_status_updates_when_order_status_changes()
    {
        $order = Order::factory()->create([
            'status' => 'pending',
            'payment_status' => 'pending'
        ]);

        // Update to delivered
        $order->update(['status' => 'delivered']);
        $order->updatePaymentStatusFromOrderStatus();
        
        $this->assertEquals('paid', $order->fresh()->payment_status);

        // Update to cancelled
        $order->update(['status' => 'cancelled']);
        $order->updatePaymentStatusFromOrderStatus();
        
        $this->assertEquals('cancelled', $order->fresh()->payment_status);
    }
}
