<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile – E-Dukan</title>
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

        .profile-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--slate) 0%, var(--primary) 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }

        .stat-card {
            background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
            color: #ffffff;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            text-align: center;
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

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    @include('shop.partials.header')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <!-- Profile Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card profile-card">
                        <div class="profile-header">
                            <div class="mb-3">
                                <i class="fas fa-user-circle fa-4x"></i>
                            </div>
                            <h2 class="mb-2">{{ $user->name }}</h2>
                            <p class="mb-0 opacity-75">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card profile-card">
                        <div class="card-header bg-white">
                            <h4 class="mb-0"><i class="fas fa-info-circle me-2"></i>Profile Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Full Name</label>
                                    <p class="form-control-plaintext">{{ $user->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Email Address</label>
                                    <p class="form-control-plaintext">{{ $user->email }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Member Since</label>
                                    <p class="form-control-plaintext">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold text-muted">Last Updated</label>
                                    <p class="form-control-plaintext">{{ $user->updated_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Statistics -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card profile-card">
                        <div class="card-header bg-white">
                            <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Account Statistics</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card info">
                                        <div class="stat-value">{{ \App\Models\Order::where('user_id', $user->id)->count() }}</div>
                                        <div class="stat-label">Total Orders</div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card success">
                                        <div class="stat-value">${{ number_format(\App\Models\Order::where('user_id', $user->id)->sum('total_amount'), 2) }}</div>
                                        <div class="stat-label">Total Spent</div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="stat-card warning">
                                        <div class="stat-value">{{ \App\Models\Cart::where('user_id', $user->id)->sum('quantity') }}</div>
                                        <div class="stat-label">Items in Cart</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="card profile-card">
                        <div class="card-header bg-white">
                            <h4 class="mb-0"><i class="fas fa-cogs me-2"></i>Account Actions</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-user-edit me-2"></i>Edit Profile
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('user.orders') }}" class="btn btn-outline-primary w-100">
                                        <i class="fas fa-box me-2"></i>View Orders
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="{{ route('shop.index') }}" class="btn btn-outline-success w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Continue Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
