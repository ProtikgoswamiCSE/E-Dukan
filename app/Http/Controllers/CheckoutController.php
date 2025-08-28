<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index(Request $request)
    {
        // Check if this is a direct product purchase
        if ($request->has('product') && $request->has('quantity')) {
            $productId = $request->product;
            $quantity = $request->quantity;
            
            // Get the product
            $product = \App\Models\Product::findOrFail($productId);
            
            // Create a temporary cart item for direct purchase
            $directPurchase = (object) [
                'product_id' => $product->id,
                'product' => $product,
                'quantity' => $quantity,
                'price' => $product->price,
                'total' => $product->price * $quantity,
                'is_direct_purchase' => true
            ];
            
            $cartItems = collect([$directPurchase]);
            $total = $directPurchase->total;
            $user = Auth::user();
            
            return view('shop.checkout', compact('cartItems', 'total', 'user', 'directPurchase'));
        }
        
        // Regular cart checkout
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('shop.cart')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum('total');
        $user = Auth::user();

        return view('shop.checkout', compact('cartItems', 'total', 'user'));
    }

    /**
     * Process the checkout
     */
    public function process(Request $request)
    {
        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check if this is a direct product purchase
        $isDirectPurchase = false;
        if ($request->has('product') && $request->has('quantity')) {
            $productId = $request->product;
            $quantity = $request->quantity;
            
            // Get the product
            $product = \App\Models\Product::findOrFail($productId);
            
            // Create a temporary cart item for direct purchase
            $directPurchase = (object) [
                'product_id' => $product->id,
                'product' => $product,
                'quantity' => $quantity,
                'price' => $product->price,
                'total' => $product->price * $quantity,
                'is_direct_purchase' => true
            ];
            
            $cartItems = collect([$directPurchase]);
            $total = $directPurchase->total;
            $isDirectPurchase = true;
        } else {
            // Regular cart checkout
            $cartItems = $this->getCartItems();

            if ($cartItems->isEmpty()) {
                return redirect()->route('shop.cart')->with('error', 'Your cart is empty!');
            }

            $total = $cartItems->sum('total');
        }

        try {
            DB::beginTransaction();

            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $total,
                'payment_method' => 'cash_on_delivery',
                'payment_status' => 'pending',
                'status' => 'pending',
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'shipping_country' => $request->shipping_country,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'product_name' => $cartItem->product->name,
                    'product_price' => $cartItem->price,
                    'quantity' => $cartItem->quantity,
                    'total_price' => $cartItem->total,
                ]);

                // Reduce product stock
                $product = $cartItem->product;
                $product->decrement('stock', $cartItem->quantity);
            }

            // Clear the cart only for regular cart checkout
            if (!$isDirectPurchase) {
                $cartItems->each->delete();
            }

            DB::commit();

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }

    /**
     * Display order success page
     */
    public function success(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('shop.checkout-success', compact('order'));
    }

    /**
     * Get cart items for current user/session
     */
    private function getCartItems()
    {
        $sessionId = Session::getId();
        $userId = Auth::id();

        return Cart::with('product')
            ->where(function ($query) use ($sessionId, $userId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
    }
}
