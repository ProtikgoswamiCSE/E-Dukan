<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Slider;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('is_admin', false)->count();
        $totalAdmins = User::where('is_admin', true)->count();
        $totalSliders = Slider::count();
        $totalOrders = Order::count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalUsers', 'totalAdmins', 'totalSliders', 'totalOrders'));
    }

    /**
     * Display all users
     */
    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    /**
     * Display categories management
     */
    public function categories()
    {
        $categories = Category::with('parent', 'subcategories')
            ->withCount('products')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15);
        $parentCategories = Category::parents()->active()->ordered()->get();

        return view('admin.categories', compact('categories', 'parentCategories'));
    }

    /**
     * Store a new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_visible' => $request->boolean('is_visible', true),
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $categoryData['image'] = 'images/categories/' . $imageName;
        }

        Category::create($categoryData);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    /**
     * Update a category
     */
    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_visible' => 'boolean',
        ]);

        $categoryData = [
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_visible' => $request->boolean('is_visible'),
            'is_active' => $request->has('is_active'),
            'sort_order' => $request->sort_order ?? 0,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
            $categoryData['image'] = 'images/categories/' . $imageName;
        }

        $category->update($categoryData);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    /**
     * Delete a category
     */
    public function destroyCategory(Category $category)
    {
        // Check if category has products
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete category that has products. Please move or delete the products first.');
        }

        // Check if category has subcategories
        if ($category->subcategories()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete category that has subcategories. Please delete the subcategories first.');
        }

        // Delete image if exists
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    /**
     * Display products management
     */
    public function products()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $categories = Category::all();
        return view('admin.products', compact('products', 'categories'));
    }

    /**
     * Show the create form for a new product
     */
    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a new product
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'is_best_seller' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_visible' => $request->boolean('is_visible', true),
            'is_featured' => $request->boolean('is_featured', false),
            'is_best_seller' => $request->boolean('is_best_seller', false),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    /**
     * Show the edit form for a product
     */
    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update a product
     */
    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
            'is_best_seller' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'is_visible' => $request->boolean('is_visible'),
            'is_featured' => $request->boolean('is_featured'),
            'is_best_seller' => $request->boolean('is_best_seller'),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product
     */
    public function destroyProduct(Product $product)
    {
        // Delete image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    /**
     * Display orders management
     */
    public function orders(Request $request)
    {
        $query = Order::with(['user', 'orderItems']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->latest()->paginate(15);

        // Get counts for summary cards
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $pendingPayments = Order::where('payment_status', 'pending')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();

        return view('admin.orders', compact(
            'orders', 
            'totalOrders', 
            'pendingOrders', 
            'deliveredOrders', 
            'pendingPayments', 
            'cancelledOrders'
        ));
    }

    /**
     * Update order status
     */
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $status = $request->status;
        
        $order->update([
            'status' => $status,
            'delivered_at' => $status === 'delivered' ? now() : null
        ]);

        // Update payment status based on order status
        $order->updatePaymentStatusFromOrderStatus();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Delete a user
     */
    public function destroyUser(User $user)
    {
        // Prevent deleting admin users
        if ($user->is_admin) {
            return redirect()->back()->with('error', 'Cannot delete admin users!');
        }

        // Prevent deleting the current logged-in user
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Cannot delete your own account!');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    /**
     * Display sliders management
     */
    public function sliders()
    {
        $sliders = Slider::ordered()->paginate(10);
        return view('admin.sliders', compact('sliders'));
    }

    /**
     * Store a new slider
     */
    public function storeSlider(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sliders'), $imageName);
            $data['image'] = 'images/sliders/' . $imageName;
        }

        Slider::create($data);

        return redirect()->back()->with('success', 'Slider created successfully!');
    }

    /**
     * Update a slider
     */
    public function updateSlider(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }

            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/sliders'), $imageName);
            $data['image'] = 'images/sliders/' . $imageName;
        }

        $slider->update($data);

        return redirect()->back()->with('success', 'Slider updated successfully!');
    }

    /**
     * Delete a slider
     */
    public function destroySlider(Slider $slider)
    {
        // Delete image if exists
        if ($slider->image && file_exists(public_path($slider->image))) {
            unlink(public_path($slider->image));
        }

        $slider->delete();
        return redirect()->back()->with('success', 'Slider deleted successfully!');
    }

    /**
     * Delete an order
     */
    public function destroyOrder(Order $order)
    {
        try {
            // Delete the order (this will cascade delete order items due to foreign key constraints)
            $order->delete();
            return redirect()->back()->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order. Please try again.');
        }
    }

    // fixSliderYear helper removed per request
}
