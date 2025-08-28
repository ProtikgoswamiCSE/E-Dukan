<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard – E-Dukan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #059669; /* emerald */
            --primary-dark: #047857;
            --accent: #06b6d4; /* cyan */
            --indigo: #6366f1;
            --warning: #f59e0b; /* amber */
            --slate: #0f172a; /* slate-900 */
            --muted: #6b7280; /* slate-500 */
            --bg: #f8fafc;
            --card: #ffffff;
        }

        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .stat-card.success {
            background: linear-gradient(135deg, #065f46 0%, #10b981 100%);
        }

        .stat-card.warning {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%);
        }

        .stat-card.info {
            background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%);
        }

        .order-item {
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
        }

        .order-item:hover {
            border-left-color: var(--primary-dark);
            background-color: #f8f9fa;
        }

        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome-banner {
            background: linear-gradient(135deg, var(--slate) 0%, var(--primary) 100%);
            color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
        }

        /* Buttons and text overrides to match palette */
        .text-primary { color: var(--primary) !important; }
        .text-success { color: var(--primary) !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { color: #fff; background: var(--primary); border-color: var(--primary); }
        .btn-outline-info { color: var(--accent); border-color: var(--accent); }
        .btn-outline-info:hover { color: #fff; background: var(--accent); border-color: var(--accent); }
    </style>
</head>

<body>
    <!-- Header Top -->
    <div class="header-top bg-dark text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Welcome to E-Dukan!</span>
                </div>
                <div class="col-md-6 text-end">
                    <span>Hello, {{ $user->name }}!</span>
                    <a href="{{ route('logout') }}" class="text-white ms-2"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header bg-white shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('shop.index') }}">
                    <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan Logo" height="60" style="max-width: 200px; object-fit: contain;">
                </a>

                <div class="search-container flex-grow-1 mx-4">
                    <form action="{{ route('shop.search') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control" placeholder="Search in E-Dukan" value="{{ request('q') }}">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>

                <div class="navbar-nav">
                    <a href="{{ route('shop.cart') }}" class="nav-link position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cartCount }}
                        </span>
                        @endif
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('shop.index') }}" class="nav-link">
                        <i class="fas fa-store"></i> Shop
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="mb-2">Welcome back, {{ $user->name }}!</h1>
                        <p class="mb-0 opacity-75">Here's what's happening with your account today.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex justify-content-end">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-4x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $totalOrders }}</h3>
                                <p class="mb-0 opacity-75">Total Orders</p>
                            </div>
                            <i class="fas fa-shopping-bag fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $pendingOrders }}</h3>
                                <p class="mb-0 opacity-75">Pending Orders</p>
                            </div>
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">{{ $completedOrders }}</h3>
                                <p class="mb-0 opacity-75">Completed</p>
                            </div>
                            <i class="fas fa-check-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="stat-card info">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">@money($totalSpent)</h3>
                                <p class="mb-0 opacity-75">Total Spent</p>
                            </div>
                            <i class="fas fa-dollar-sign fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Orders -->
                <div class="col-lg-8">
                    <div class="card dashboard-card mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-history me-2 text-primary"></i>Recent Orders</h5>
                                <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse($recentOrders as $order)
                            <div class="order-item p-3 rounded mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Order #{{ $order->order_number }}</h6>
                                        <p class="text-muted mb-1 small">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-{{ $order->status_badge }} me-2">{{ ucfirst($order->status) }}</span>
                                            <small class="text-muted">{{ $order->orderItems->count() }} items</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <h6 class="text-success mb-0">@money($order->total_amount)</h6>
                                        <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary mt-1">View</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                                <h6>No orders yet</h6>
                                <p class="text-muted">Start shopping to see your orders here!</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">
                                    <i class="fas fa-store me-1"></i>Start Shopping
                                </a>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4">
                    <div class="card dashboard-card mb-4">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0"><i class="fas fa-bolt me-2 text-warning"></i>Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">
                                    <i class="fas fa-store me-1"></i>Browse Products
                                </a>
                                <a href="{{ route('shop.cart') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-shopping-cart me-1"></i>View Cart
                                </a>
                                <a href="{{ route('user.orders') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list me-1"></i>My Orders
                                </a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-info">
                                    <i class="fas fa-user-edit me-1"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div class="card dashboard-card">
                        <div class="card-header bg-white border-0 py-3">
                            <h5 class="mb-0"><i class="fas fa-user me-2 text-info"></i>Account Info</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <small class="text-muted">Name</small>
                                <p class="mb-0">{{ $user->name }}</p>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Email</small>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="mb-2">
                                <small class="text-muted">Member Since</small>
                                <p class="mb-0">{{ $user->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommended Products -->
            @if($recommendedProducts->isNotEmpty())
            <div class="card dashboard-card mt-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0"><i class="fas fa-star me-2 text-warning"></i>Recommended For You</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($recommendedProducts as $product)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="card product-card h-100">
                                <div class="position-relative">
                                    @if($product->image && file_exists(public_path($product->image)))
                                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ Str::limit($product->name, 30) }}</h6>
                                    <p class="card-text text-muted small">{{ Str::limit($product->description, 60) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="h6 text-primary">@money($product->price)</span>
                                            <small class="text-muted">Stock: {{ $product->stock }}</small>
                                        </div>
                                        <div class="d-grid">
                                            <a href="{{ route('shop.product', $product->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2025 E-Dukan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>