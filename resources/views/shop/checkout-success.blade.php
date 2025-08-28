<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful – E-Dukan</title>
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
                    <a href="{{ route('shop.profile') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                    </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-5">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h1 class="text-success mt-3">Order Placed Successfully!</h1>
                        <p class="lead text-muted">Thank you for your order. We'll process it shortly.</p>
                    </div>

                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Order Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Order Number:</strong><br>
                                    <span class="text-primary">#{{ $order->order_number }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Order Date:</strong><br>
                                    {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Total Amount:</strong><br>
                                    <span class="h5 text-success">@money($order->total_amount)</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Payment Method:</strong><br>
                                    <span class="badge bg-info">Cash on Delivery</span>
                                </div>
                            </div>

                            <hr>

                            <h6><i class="fas fa-shipping-fast me-2"></i>Shipping Information</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>{{ $order->shipping_name }}</strong><br>
                                    {{ $order->shipping_email }}<br>
                                    {{ $order->shipping_phone }}
                                </div>
                                <div class="col-md-6">
                                    {{ $order->shipping_address }}<br>
                                    {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}<br>
                                    {{ $order->shipping_country }}
                                </div>
                            </div>

                            @if($order->notes)
                            <hr>
                            <h6><i class="fas fa-sticky-note me-2"></i>Order Notes</h6>
                            <p class="text-muted">{{ $order->notes }}</p>
                            @endif

                            <hr>

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
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>What's Next?</strong><br>
                            We'll call you within 24 hours to confirm your order and delivery details.
                            You can pay cash when the order is delivered to your address.
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('shop.index') }}" class="btn btn-primary me-3">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('shop.profile') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i>View My Orders
                        </a>
                    </div>
                </div>
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