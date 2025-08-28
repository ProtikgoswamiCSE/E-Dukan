<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders – E-Dukan</title>
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

        .order-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            background: linear-gradient(135deg, var(--slate) 0%, var(--primary) 100%);
            color: #ffffff;
            padding: 20px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-shipped { background: #e0e7ff; color: #3730a3; }
        .status-delivered { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }

        .cancelled-order {
            opacity: 0.7;
        }

        .cancelled-order .order-header {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        }

        .order-item {
            border-left: 4px solid var(--primary);
            transition: all 0.3s ease;
            padding: 15px;
        }

        .order-item:hover {
            border-left-color: var(--primary-dark);
            background-color: #f8f9fa;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--muted);
            margin-bottom: 20px;
        }

        /* Prevent modal flickering */
        .modal {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .modal-dialog {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        /* Smooth button transitions */
        .cancel-order-btn {
            transition: all 0.2s ease;
        }

        .cancel-order-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(220, 38, 38, 0.2);
        }

        .cancel-order-btn:active {
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <!-- Header Top -->
    <div class="header-top bg-dark text-white py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <small><i class="fas fa-phone me-2"></i>+1 234 567 8900</small>
                    <small class="ms-3"><i class="fas fa-envelope me-2"></i>info@edukan.com</small>
                </div>
                <div class="col-md-6 text-end">
                    <small><i class="fas fa-truck me-2"></i>Free shipping on orders over $50</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="bg-white shadow-sm border-bottom">
        <div class="container">
            <div class="row align-items-center py-3">
                <div class="col-md-3">
                    <a href="{{ route('shop.index') }}" class="d-flex align-items-center text-decoration-none">
                        <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan Logo" height="40">
                        <span class="ms-3 h4 mb-0 text-dark">E-Dukan</span>
                    </a>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search products...">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="{{ route('shop.cart') }}" class="btn btn-outline-primary me-3 position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-2"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}"><i class="fas fa-box me-2"></i>My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="h2 text-dark mb-2">My Orders</h1>
                    <p class="text-muted">Track your order history and status</p>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> You can only cancel orders that are still in "Pending" status. Once an order is processed, shipped, or delivered, it cannot be cancelled.
                    </div>
                </div>
            </div>

            @if($orders->count() > 0)
                <!-- Orders List -->
                <div class="row">
                    <div class="col-12">
                        @foreach($orders as $order)
                        <div class="card order-card {{ $order->status === 'cancelled' ? 'cancelled-order' : '' }}">
                            <!-- Order Header -->
                            <div class="order-header">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-1">Order #{{ $order->id }}</h5>
                                        <small class="opacity-75">Placed on {{ $order->created_at->format('M d, Y \a\t g:i A') }}</small>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <span class="status-badge status-{{ $order->status }} me-3">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <span class="h5 mb-0">${{ number_format($order->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="card-body">
                                @foreach($order->orderItems as $item)
                                <div class="order-item">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            @if($item->product && $item->product->image)
                                                <img src="{{ asset('images/products/' . $item->product->image) }}" 
                                                     alt="{{ $item->product->name }}" 
                                                     class="img-fluid rounded" style="max-height: 60px;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 60px; width: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-1">{{ $item->product ? $item->product->name : 'Product Unavailable' }}</h6>
                                            <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                            @if($item->product)
                                                <br><small class="text-muted">Price: ${{ number_format($item->price, 2) }}</small>
                                            @endif
                                        </div>
                                        <div class="col-md-4 text-md-end">
                                            <span class="h6 mb-0">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <!-- Order Footer -->
                                <div class="border-top pt-3 mt-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <small class="text-muted">
                                                <strong>Shipping Address:</strong><br>
                                                {{ $order->shipping_address ?? 'Address not provided' }}
                                            </small>
                                            @if($order->status === 'cancelled' && $order->notes)
                                                <br><br>
                                                <small class="text-muted">
                                                    <strong>Cancellation Details:</strong><br>
                                                    @php
                                                        $notes = explode("\n", $order->notes);
                                                        $cancellationInfo = array_filter($notes, function($note) {
                                                            return str_contains($note, 'Order cancelled') || str_contains($note, 'Reason:');
                                                        });
                                                    @endphp
                                                    @foreach($cancellationInfo as $note)
                                                        {{ $note }}<br>
                                                    @endforeach
                                                </small>
                                            @endif
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            @if($order->status === 'delivered')
                                                <button class="btn btn-outline-primary btn-sm me-2" onclick="alert('Reorder functionality coming soon!')">
                                                    <i class="fas fa-redo me-1"></i>Reorder
                                                </button>
                                            @endif
                                            @if($order->status === 'pending')
                                                <button type="button" class="btn btn-outline-danger btn-sm cancel-order-btn" 
                                                        data-order-id="{{ $order->id }}" 
                                                        data-order-number="{{ $order->id }}">
                                                    <i class="fas fa-times me-1"></i>Cancel Order
                                                </button>
                                                
                                                <!-- Fallback: Direct form for non-JS users -->
                                                <form action="{{ route('user.orders.cancel', $order) }}" method="POST" class="d-none" id="fallbackForm{{ $order->id }}">
                                                    @csrf
                                                    <input type="hidden" name="cancellation_reason" value="">
                                                </form>
                                            @endif
                                            @if($order->status === 'cancelled')
                                                <span class="badge bg-secondary">Order Cancelled</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                @if($orders->hasPages())
                    <div class="row mt-4">
                        <div class="col-12">
                            <x-pagination :paginator="$orders" />
                        </div>
                    </div>
                @endif

            @else
                <!-- No Orders -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body empty-state">
                                <i class="fas fa-box-open"></i>
                                <h4 class="text-muted mb-3">No orders yet</h4>
                                <p class="text-muted mb-4">Start shopping to see your orders here</p>
                                <a href="{{ route('shop.index') }}" class="btn btn-primary">
                                    <i class="fas fa-shopping-cart me-2"></i>Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2024 E-Dukan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('policy.privacy') }}" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="{{ route('policy.terms') }}" class="text-white text-decoration-none me-3">Terms of Service</a>
                    <a href="{{ route('support.info') }}" class="text-white text-decoration-none">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Cancel Order Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cancelOrderForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to cancel this order?</p>
                        <p class="text-muted small">This action cannot be undone.</p>
                        <div class="mb-3">
                            <label for="cancellation_reason" class="form-label">Reason for cancellation (optional)</label>
                            <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" rows="3" placeholder="Please let us know why you're cancelling this order..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keep Order</button>
                        <button type="submit" class="btn btn-danger">Cancel Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Handle cancel order button clicks
            const cancelButtons = document.querySelectorAll('.cancel-order-btn');
            const cancelModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'));
            const cancelForm = document.getElementById('cancelOrderForm');

            console.log('Found cancel buttons:', cancelButtons.length);

            cancelButtons.forEach(function(button, index) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const orderId = this.getAttribute('data-order-id');
                    const orderNumber = this.getAttribute('data-order-number');
                    
                    console.log('Cancel button clicked for order:', orderId);
                    
                    // Try to show modal first
                    try {
                        // Update modal title
                        document.getElementById('cancelOrderModalLabel').textContent = `Cancel Order #${orderNumber}`;
                        
                        // Update form action
                        cancelForm.action = `/orders/${orderId}/cancel`;
                        
                        // Clear previous reason
                        document.getElementById('cancellation_reason').value = '';
                        
                        // Show modal
                        cancelModal.show();
                    } catch (error) {
                        console.error('Modal error:', error);
                        // Fallback to simple confirmation
                        if (confirm(`Are you sure you want to cancel Order #${orderNumber}? This action cannot be undone.`)) {
                            // Use fallback form
                            const fallbackForm = document.getElementById(`fallbackForm${orderId}`);
                            if (fallbackForm) {
                                fallbackForm.submit();
                            }
                        }
                    }
                });
            });

            // Handle form submission
            cancelForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                console.log('Form submitted, cancelling order...');
                
                // Disable button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Cancelling...';
                
                // Hide modal after submission
                setTimeout(() => {
                    cancelModal.hide();
                }, 1000);
                
                // Re-enable after a delay if there's an error
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 10000);
            });

            // Ensure modal is properly initialized
            if (typeof bootstrap !== 'undefined') {
                console.log('Bootstrap Modal initialized successfully');
            } else {
                console.error('Bootstrap Modal not available');
            }
        });
    </script>
</body>
</html>
