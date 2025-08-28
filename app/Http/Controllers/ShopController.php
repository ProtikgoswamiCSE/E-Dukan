<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Order;
use App\Models\HomepageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ShopController extends Controller
{
    /**
     * Display the shop homepage with products
     */
    public function index()
    {
        // Get sliders (guarded if table doesn't exist yet)
        $sliders = collect();
        if (Schema::hasTable('sliders')) {
            $sliders = Slider::active()->ordered()->get();
        }

        // Get featured products
        $featuredProducts = Product::visible()
            ->featured()
            ->inStock()
            ->with('category')
            ->take(8)
            ->get();

        // Get new arrivals (latest products)
        $newArrivals = Product::visible()
            ->inStock()
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        // Get best selling products (admin-marked)
        $bestSellers = Product::visible()
            ->bestSeller()
            ->inStock()
            ->with('category')
            ->take(8)
            ->get();

        // Get main categories with images for featured categories section
        $featuredCategories = Category::visible()
            ->whereNull('parent_id')
            ->whereNotNull('image')
            ->take(8)
            ->get();

        // Get all categories for navigation
        $categories = Category::visible()->get();

        // Get homepage sections (value proposition, testimonials, etc.)
        $valuePropSections = HomepageSection::bySection('value_proposition')
            ->active()
            ->ordered()
            ->get();

        $testimonials = HomepageSection::bySection('testimonials')
            ->active()
            ->ordered()
            ->take(6)
            ->get();

        $brandPartners = HomepageSection::bySection('brand_partners')
            ->active()
            ->ordered()
            ->get();

        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.index', compact(
            'sliders',
            'featuredProducts',
            'newArrivals',
            'bestSellers',
            'featuredCategories',
            'categories',
            'valuePropSections',
            'testimonials',
            'brandPartners',
            'cartCount'
        ));
    }

    /**
     * Display products by category
     */
    public function category(Request $request, $categoryId = null)
    {
        $categories = Category::visible()->get();

        if ($categoryId) {
            $category = Category::visible()->findOrFail($categoryId);
            $products = Product::visible()
                ->inStock()
                ->where('category_id', $categoryId)
                ->with('category')
                ->paginate(12);
        } else {
            $category = null;
            $products = Product::visible()
                ->inStock()
                ->with('category')
                ->paginate(12);
        }

        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.category', compact('products', 'categories', 'category', 'cartCount'));
    }

    /**
     * Display product details
     */
    public function product($id)
    {
        $product = Product::visible()
            ->with('category')
            ->findOrFail($id);

        // Get related products from same category
        $relatedProducts = Product::visible()
            ->inStock()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Build Previous/Next navigation within the same category
        $categoryProductIds = Product::visible()
            ->where('category_id', $product->category_id)
            ->orderBy('id')
            ->pluck('id')
            ->toArray();

        $totalInCategory = count($categoryProductIds);
        $currentIndex = array_search($product->id, $categoryProductIds, true);
        $positionInCategory = $currentIndex !== false ? ($currentIndex + 1) : null;

        $prevProductId = ($currentIndex !== false && $currentIndex > 0)
            ? $categoryProductIds[$currentIndex - 1]
            : null;
        $nextProductId = ($currentIndex !== false && $currentIndex < $totalInCategory - 1)
            ? $categoryProductIds[$currentIndex + 1]
            : null;

        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.product', compact(
            'product',
            'relatedProducts',
            'prevProductId',
            'nextProductId',
            'positionInCategory',
            'totalInCategory',
            'cartCount'
        ));
    }

    /**
     * Display shopping cart
     */
    public function cart()
    {
        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.cart', compact('cartCount'));
    }

    /**
     * Display checkout page
     */
    public function checkout()
    {
        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.checkout', compact('cartCount'));
    }

    /**
     * Display user profile with order history
     */
    public function profile()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);

        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.profile', compact('user', 'orders', 'cartCount'));
    }

    /**
     * Search products
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $products = Product::visible()
            ->inStock()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('category')
            ->paginate(12);

        // Get cart count for authenticated users
        $cartCount = 0;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $cartCount = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->sum('quantity');
        }

        return view('shop.search', compact('products', 'query', 'cartCount'));
    }
}
