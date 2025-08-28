<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart – E-Dukan</title>
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
                    @else
                    <a href="{{ route('login') }}" class="text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-white ms-2">Register</a>
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
                    <a href="{{ route('shop.profile') }}" class="nav-link">
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
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">Shopping Cart ({{ $cartItems->count() }} items)</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            @forelse($cartItems as $item)
                            <div class="row align-items-center border-bottom py-3">
                                <div class="col-md-2">
                                    @if($item->product->image)
                                    <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}"
                                        class="img-fluid rounded" style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width: 120px; height: 120px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <small class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                                    <br>
                                    <span class="text-primary fw-bold">@money($item->price)</span>
                                </div>
                                <div class="col-md-3">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group" style="max-width: 120px;">
                                            <button class="btn btn-outline-secondary btn-sm" type="button"
                                                onclick="(function(btn){ const form = btn.closest('form'); const input = form.querySelector('input[name=quantity]'); input.stepDown(); form.submit(); })(this)">-</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" max="{{ $item->product->stock }}" class="form-control text-center"
                                                onchange="this.form.submit()">
                                            <button class="btn btn-outline-secondary btn-sm" type="button"
                                                onclick="(function(btn){ const form = btn.closest('form'); const input = form.querySelector('input[name=quantity]'); input.stepUp(); form.submit(); })(this)">+</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <span class="fw-bold">@money($item->total)</span>
                                </div>
                                <div class="col-md-1">
                                    <form action="{{ route('cart.remove', $item) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Remove this item from cart?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5>Your cart is empty</h5>
                                <p class="text-muted">Add some products to your cart to get started!</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">Continue Shopping</a>
                            </div>
                            @endforelse

                            @if($cartItems->count() > 0)
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Clear entire cart?')">
                                        <i class="fas fa-trash me-1"></i>Clear Cart
                                    </button>
                                </form>
                                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-1"></i>Continue Shopping
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if($cartItems->count() > 0)
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <span>Subtotal ({{ $cartItems->sum('quantity') }} items):</span>
                                <span>@money($total)</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Shipping:</span>
                                <span class="text-success">Free</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong class="text-primary">@money($total)</strong>
                            </div>

                            <div class="d-grid mt-3">
                                @auth
                                <a href="{{ route('shop.checkout') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-credit-card me-1"></i>Proceed to Checkout
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login to Checkout
                                </a>
                                @endauth
                            </div>

                            <div class="mt-3 text-center">
                                <small class="text-muted">
                                    <i class="fas fa-lock me-1"></i>Secure checkout with SSL encryption
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="card mt-3">
                        <div class="card-body text-center">
                            <h6 class="mb-2">We Accept</h6>
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="badge bg-primary me-2">Cash on Delivery</span>
                                <i class="fas fa-truck fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
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