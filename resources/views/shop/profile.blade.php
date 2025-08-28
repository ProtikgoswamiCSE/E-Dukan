<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – E-Dukan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="header-top bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span>Welcome to E-Dukan!</span>
                </div>
                <div class="col-md-6 text-end">
                    @auth
                    <span>Hello, {{ Auth::user()->name }}!</span>
                    <a href="{{ route('logout') }}" class="text-white ms-2"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <header class="header bg-white shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('shop.index') }}">
                    <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan Logo" class="logo-img" height="60" style="max-width: 200px; object-fit: contain;">
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
                    @auth
                    <a href="{{ route('shop.profile') }}" class="nav-link active">
                        <i class="fas fa-user"></i>
                    </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Profile Sidebar -->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-5x text-muted"></i>
                            </div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-3">{{ $user->email }}</p>
                            <div class="d-grid">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0">Quick Stats</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Total Orders</span>
                                <span class="badge bg-primary">{{ $orders->total() }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span>Member Since</span>
                                <small class="text-muted">{{ $user->created_at->format('M Y') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>My Orders</h5>
                        </div>
                        <div class="card-body">
                            @forelse($orders as $order)
                            <div class="order-item border rounded p-3 mb-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">Order #{{ $order->order_number }}</h6>
                                                <small class="text-muted">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</small>
                                            </div>
                                            <span class="badge bg-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                                        </div>
                                        
                                        <div class="order-items">
                                            @foreach($order->orderItems->take(3) as $item)
                                            <div class="d-flex align-items-center mb-1">
                                                <small class="text-muted me-2">{{ $item->quantity }}x</small>
                                                <small>{{ $item->product_name }}</small>
                                            </div>
                                            @endforeach
                                            @if($order->orderItems->count() > 3)
                                                <small class="text-muted">... and {{ $order->orderItems->count() - 3 }} more items</small>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 text-md-end">
                                        <div class="mb-2">
                                            <strong class="text-success">@money($order->total_amount)</strong>
                                        </div>
                                        <div class="mb-2">
                                            <small class="text-muted">{{ $order->orderItems->count() }} items</small>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                                data-bs-target="#orderModal{{ $order->id }}">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                                <h5>No orders yet</h5>
                                <p class="text-muted">When you place orders, they'll appear here.</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-bag me-1"></i>Start Shopping
                                </a>
                            </div>
                            @endforelse

                            <!-- Pagination -->
                            @if($orders->hasPages())
                            <div class="d-flex justify-content-center">
                                {{ $orders->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Order Detail Modals -->
    @foreach($orders as $order)
    <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Details - {{ $order->order_number }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order Date:</strong><br>
                            {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Status:</strong><br>
                            <span class="badge bg-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Payment Method:</strong><br>
                            {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                        </div>
                        <div class="col-md-6">
                            <strong>Total Amount:</strong><br>
                            <span class="h5 text-success">@money($order->total_amount)</span>
                        </div>
                    </div>

                    <h6><i class="fas fa-shipping-fast me-2"></i>Shipping Address</h6>
                    <div class="mb-3">
                        <p class="mb-1">{{ $order->shipping_address }}</p>
                        <p class="mb-1">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                        <p class="mb-1">{{ $order->shipping_country }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
                    </div>

                    @if($order->notes)
                    <h6><i class="fas fa-sticky-note me-2"></i>Order Notes</h6>
                    <p class="text-muted mb-3">{{ $order->notes }}</p>
                    @endif

                    <h6><i class="fas fa-box me-2"></i>Order Items</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>@money($item->product_price)</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>@money($item->total_price)</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total Amount</th>
                                    <th>@money($order->total_amount)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($order->delivered_at)
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Delivered on:</strong> {{ $order->delivered_at->format('M d, Y \a\t h:i A') }}
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if($order->status === 'delivered')
                        <a href="{{ route('shop.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-bag me-1"></i>Shop Again
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

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