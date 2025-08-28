<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard
     */
    public function index()
    {
        $user = Auth::user();

        // Get user's order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)->where('status', 'pending')->count();
        $completedOrders = Order::where('user_id', $user->id)->where('status', 'delivered')->count();
        $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');

        // Get recent orders
        $recentOrders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->take(5)
            ->get();

        // Get recommended products (based on user's order history)
        $recommendedProducts = Product::whereHas('orderItems.order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->distinct()->take(8)->get();

        // If no order history, show featured products
        if ($recommendedProducts->isEmpty()) {
            $recommendedProducts = Product::where('stock', '>', 0)->take(8)->get();
        }

        // Get cart count
        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return view('user.dashboard', compact(
            'user',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'totalSpent',
            'recentOrders',
            'recommendedProducts',
            'cartCount'
        ));
    }

    /**
     * Display user's order history
     */
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);

        // Get cart count
        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return view('user.orders', compact('orders', 'cartCount'));
    }

    /**
     * Display user's profile
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Get cart count
        $cartCount = Cart::where('user_id', $user->id)->sum('quantity');

        return view('user.profile', compact('user', 'cartCount'));
    }

    /**
     * Cancel an order
     */
    public function cancelOrder(Request $request, Order $order)
    {
        // Check if the user owns this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Check if order can be cancelled using the model method
        if (!$order->canBeCancelled()) {
            return back()->with('error', 'This order cannot be cancelled. Only pending orders can be cancelled.');
        }

        // Get cancellation reason
        $cancellationReason = $request->input('cancellation_reason');
        
        // Prepare notes update
        $notes = $order->notes ? $order->notes . "\n\n" : "";
        $notes .= "Order cancelled on " . now()->format('M d, Y \a\t g:i A');
        if ($cancellationReason) {
            $notes .= "\nReason: " . $cancellationReason;
        }

        // Cancel the order using the model method
        if ($order->cancel()) {
            // Update notes with cancellation information
            $order->update(['notes' => $notes]);
            
            return back()->with('success', 'Order #' . $order->id . ' has been cancelled successfully.');
        }

        return back()->with('error', 'Failed to cancel the order. Please try again or contact support.');
    }
}
