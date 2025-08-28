<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} – E-Dukan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Header -->
    <header class="header bg-white shadow-sm">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('shop.index') }}">
                    <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan Logo" height="40">
                </a>

                <div class="search-container flex-grow-1 mx-4">
                    <form action="{{ route('shop.search') }}" method="GET" class="d-flex">
                        <input type="text" name="q" class="form-control" placeholder="Search in E-Dukan" value="{{ request('q') }}" style="border-right:none;border-radius:9999px 0 0 9999px;padding:10px 14px;height:42px;">
                        <button class="btn btn-primary" type="submit" style="border-left:none;border-radius:0 9999px 9999px 0;padding:10px 14px;height:42px;"><i class="fas fa-search"></i></button>
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
                    <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->id) }}">{{ $product->category->name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>

            <!-- Product Details -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="ratio ratio-1x1 bg-light rounded">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" class="w-100 h-100" alt="{{ $product->name }}" style="object-fit: contain;">
                            @else
                                <div class="d-flex align-items-center justify-content-center w-100 h-100">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm p-4 h-100">
                        <h1 class="h2 mb-2 fw-semibold">{{ $product->name }}</h1>
                        <div class="mb-3">
                            <span class="badge rounded-pill bg-dark">{{ $product->category->name }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="display-6 text-success fw-bold">@money($product->price)</span>
                        </div>

                        <div class="mb-4">
                            @if($product->stock > 0)
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>In Stock ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Out of Stock</span>
                            @endif
                        </div>

                        @if($product->stock > 0)
                        <div class="mb-3">
                            <label class="form-label small text-muted">Quantity</label>
                            <div class="input-group" style="max-width: 240px;">
                                <button class="btn btn-outline-secondary" type="button" id="qty-minus">-</button>
                                <input type="number" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}" id="quantity">
                                <button class="btn btn-outline-secondary" type="button" id="qty-plus">+</button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-sm-flex mb-4">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="me-sm-2 flex-grow-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1" id="add-to-cart-quantity">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                </button>
                            </form>
                            <form action="{{ route('shop.checkout') }}" method="GET" class="flex-grow-1">
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1" id="buy-now-quantity">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-bolt me-1"></i>Buy Now
                                </button>
                            </form>
                        </div>

                        @guest
                        <div class="alert alert-info py-2 mb-4">
                            <i class="fas fa-info-circle me-1"></i>
                            Please <a href="{{ route('login') }}">login</a> to add items to cart.
                        </div>
                        @endguest
                        @else
                        <div class="alert alert-warning py-2 mb-4">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            This product is currently out of stock.
                        </div>
                        @endif

                        <div class="border rounded p-3 bg-light">
                            <h5 class="mb-2">Description</h5>
                            <p class="mb-0 text-muted">{{ $product->description }}</p>
                        </div>

                        <div class="mt-4">
                            <div class="row g-3">
                                <div class="col-12 col-sm-4">
                                    <div class="border rounded-3 p-3 h-100 text-center bg-white">
                                        <i class="fas fa-shield-check text-success mb-2"></i>
                                        <div class="small fw-semibold">Genuine Product</div>
                                        <div class="text-muted small">Quality checked</div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="border rounded-3 p-3 h-100 text-center bg-white">
                                        <i class="fas fa-undo-alt text-primary mb-2"></i>
                                        <div class="small fw-semibold">Easy Return</div>
                                        <div class="text-muted small">7 day hassle free</div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="border rounded-3 p-3 h-100 text-center bg-white">
                                        <i class="fas fa-truck text-warning mb-2"></i>
                                        <div class="small fw-semibold">Fast Delivery</div>
                                        <div class="text-muted small">Across Bangladesh</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
            <div class="related-products mt-5">
                <h3 class="mb-4">Related Products</h3>
                <div class="row">
                    @foreach($relatedProducts as $relatedProduct)
                    @php $productUrl = request()->getSchemeAndHttpHost() . request()->getBaseUrl() . '/shop/product/' . $relatedProduct->id; @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 position-relative" data-href="{{ $productUrl }}" style="cursor: pointer;">
                            @if($relatedProduct->image)
                            <a href="{{ $productUrl }}">
                                <img src="{{ asset($relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 200px; object-fit: contain; background:#fff;">
                            </a>
                            @else
                            <a href="{{ $productUrl }}" class="text-decoration-none">
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                            </a>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">
                                    <a href="{{ $productUrl }}" class="text-decoration-none text-dark">{{ $relatedProduct->name }}</a>
                                </h6>
                                <p class="card-text text-muted small">{{ Str::limit($relatedProduct->description, 60) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="h6 text-primary">@money($relatedProduct->price)</span>
                                        <small class="text-muted">Stock: {{ $relatedProduct->stock }}</small>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <a href="{{ $productUrl }}" class="btn btn-outline-primary btn-sm" onclick="window.location.href='{{ $productUrl }}'; return false;">View Details</a>
                                    </div>
                                </div>
                                <a href="{{ $productUrl }}" class="stretched-link" aria-label="View {{ $relatedProduct->name }}"></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
    <script>
        (function() {
            const qtyInput = document.getElementById('quantity');
            const addToCartQty = document.getElementById('add-to-cart-quantity');
            const buyNowQty = document.getElementById('buy-now-quantity');
            const minusBtn = document.getElementById('qty-minus');
            const plusBtn = document.getElementById('qty-plus');
            if (qtyInput && addToCartQty && buyNowQty) {
                const sync = () => {
                    addToCartQty.value = qtyInput.value || 1;
                    buyNowQty.value = qtyInput.value || 1;
                };
                qtyInput.addEventListener('input', sync);
                qtyInput.addEventListener('change', sync);
                if (minusBtn) {
                    minusBtn.addEventListener('click', function() {
                        const min = parseInt(qtyInput.min || '1', 10);
                        let current = parseInt(qtyInput.value || '1', 10);
                        if (isNaN(current)) current = 1;
                        qtyInput.value = Math.max(min, current - 1);
                        qtyInput.dispatchEvent(new Event('change'));
                    });
                }
                if (plusBtn) {
                    plusBtn.addEventListener('click', function() {
                        const max = parseInt(qtyInput.max || '9999', 10);
                        let current = parseInt(qtyInput.value || '1', 10);
                        if (isNaN(current)) current = 1;
                        qtyInput.value = Math.min(max, current + 1);
                        qtyInput.dispatchEvent(new Event('change'));
                    });
                }
                sync();
            }
            
            // Make entire related product card clickable as a fallback if overlays block anchors
            document.querySelectorAll('.related-products .card[data-href]').forEach(function(card) {
                card.addEventListener('click', function(e) {
                    const tag = e.target.tagName.toLowerCase();
                    if (tag === 'a' || tag === 'button' || e.target.closest('a') || e.target.closest('button')) {
                        return;
                    }
                    const href = card.getAttribute('data-href');
                    if (href) {
                        window.location.href = href;
                    }
                });
            });
        })();
    </script>
</body>

</html>
