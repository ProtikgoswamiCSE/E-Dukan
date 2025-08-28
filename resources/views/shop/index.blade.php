<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Dukan – Your Premier Online Shopping Destination</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="Shop the latest fashion, electronics, and home decor at E-Dukan. Free shipping, easy returns, and 24/7 customer support.">
    <meta name="keywords" content="online shopping, ecommerce, fashion, electronics, home decor, deals, discounts">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Fallback Swiper CSS if CDN fails -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" onerror="this.onerror=null;this.href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css';">

    <style>
        :root {
            --primary-color: #059669; /* emerald-600 */
            --secondary-color: #f8fafc; /* slate-50 */
            --accent-color: #0284c7; /* sky-600 */
            --text-dark: #0f172a; /* slate-900 */
            --text-light: #475569; /* slate-600 */
            --border-color: #e2e8f0; /* slate-200 */
        }

        /* Reset margins and padding for full-width slider */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        /* Header Styles */

        .main-header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand img {
            height: 50px;
            object-fit: contain;
        }

        .search-container {
            max-width: 500px;
        }

        .search-container .form-control {
            border-right: none;
            border-radius: 9999px 0 0 9999px;
            padding: 10px 14px;
            height: 42px;
        }

        .search-container .btn {
            border-left: none;
            border-radius: 0 9999px 9999px 0;
            padding: 10px 14px;
            height: 42px;
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .nav-icon {
            position: relative;
            font-size: 20px;
            color: var(--text-dark);
            text-decoration: none;
            margin: 0 15px;
            transition: color 0.3s ease;
        }

        .nav-icon:hover {
            color: var(--primary-color);
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Hero Slider Styles */
        .hero-slider {
            height: 70vh;
            width: 100%;
            position: relative;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            width: 100%;
            height: 100%;
            transition: transform 0.3s ease;
        }

        .swiper-slide img.slider-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            transition: transform 0.3s ease;
        }

        /* Ensure smooth slide transitions */
        .swiper-wrapper {
            transition-timing-function: ease-out;
        }

        .swiper-slide-active {
            z-index: 2;
        }

        .swiper-slide-prev,
        .swiper-slide-next {
            z-index: 1;
        }

        /* Alternative image fitting options - you can switch between these */
        .swiper-slide img.fit-contain {
            object-fit: contain;
            background: rgba(0, 0, 0, 0.1);
        }

        .swiper-slide img.fit-fill {
            object-fit: fill;
        }

        .swiper-slide img.fit-scale-down {
            object-fit: scale-down;
        }

        .slide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4));
            z-index: 2;
        }

        .slide-content {
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 20px;
            position: relative;
            z-index: 3;
        }

        .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .slide-content p {
            font-size: 1.4rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .slide-btn {
            background: var(--accent-color);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
        }

        .slide-btn:hover {
            background: #e55a2b;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.6);
            color: white;
        }

        /* Swiper Navigation Styles */
        .swiper-button-next,
        .swiper-button-prev {
            color: white;
            background: rgba(0, 0, 0, 0.3);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 1000;
            cursor: pointer;
            display: flex !important;
            align-items: center;
            justify-content: center;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(0, 0, 0, 0.6);
            transform: scale(1.1);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 14px;
            font-weight: bold;
            color: white;
        }

        .swiper-button-next.swiper-button-disabled,
        .swiper-button-prev.swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .swiper-pagination {
            z-index: 1000;
        }

        .swiper-pagination-bullet {
            background: white;
            opacity: 0.7;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .swiper-pagination-bullet-active {
            opacity: 1;
            background: var(--accent-color);
            transform: scale(1.2);
        }

        /* Value Proposition Section */
        .value-prop {
            background: var(--secondary-color);
            padding: 60px 0;
        }

        .value-item {
            text-align: center;
            padding: 30px 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
        }

        .value-item:hover {
            transform: translateY(-5px);
        }

        .value-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        /* Featured Categories */
        .featured-categories {
            padding: 80px 0;
        }

        .category-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 30px 20px 20px;
            text-align: center;
        }

        .category-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .category-count {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Product Sections */
        .product-section {
            padding: 80px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: var(--text-light);
            max-width: 600px;
            margin: 0 auto;
        }

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            position: relative;
            height: 220px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: 100%;
            object-fit: contain; /* show full image within the card */
            transition: transform 0.3s ease;
            padding: 8px;
            background: #fff;
            display: block;
            margin: 0 auto;
        }

        .product-card:hover .product-image img { transform: scale(1.02); }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--accent-color);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-info {
            padding: 25px;
        }

        .product-title {
            font-size: 1rem; /* medium */
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .product-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }

        .btn-add-cart {
            grid-column: 1 / span 1;
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 6px 10px; /* medium */
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(5, 150, 105, 0.18);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
        }

        .btn-add-cart:hover {
            background: #047857;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(5, 150, 105, 0.25);
        }

        .btn-buy-now {
            grid-column: 2 / span 1;
            background: linear-gradient(135deg, var(--accent-color), #38bdf8);
            color: #fff;
            border: none;
            padding: 6px 10px; /* medium */
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            box-shadow: 0 3px 8px rgba(2, 132, 199, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-buy-now:hover {
            background: linear-gradient(135deg, #0369a1, var(--accent-color));
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 8px 16px rgba(2, 132, 199, 0.3);
        }

        .btn-view-details {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 600;
            opacity: 0.9;
            transition: color 0.2s ease, opacity 0.2s ease;
        }

        .btn-view-details:hover {
            color: var(--primary-color);
            opacity: 1;
            text-decoration: underline;
        }



        

        /* Footer */
        .footer {
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: #e5e7eb;
            padding: 64px 0 0;
        }

        .footer-section h5 {
            color: #fff;
            margin-bottom: 16px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .footer-brand { color: #9ca3af; line-height: 1.7; }

        .footer-link {
            color: #9ca3af;
            text-decoration: none;
            display: block;
            padding: 6px 0;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .footer-link:hover { color: #fff; transform: translateX(2px); }

        .social-icons { display: flex; gap: 12px; align-items: center; justify-content: center; }
        .footer-brand-wrap { text-align: center; }

        .social-icon {
            width: 38px;
            height: 38px;
            background: rgba(255,255,255,0.06);
            color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .social-icon:hover { background: #1f2937; color: #fff; transform: translateY(-2px); }

        .payment-icons { display: flex; align-items: center; gap: 12px; justify-content: center; }
        .payment-badge { background: #0b1220; color: #e5e7eb; border: 1px solid #1f2937; border-radius: 9999px; padding: 6px 12px; font-weight: 600; }

        /* Responsive */
        @media (max-width: 768px) {
            .slide-content h1 {
                font-size: 2.5rem;
            }

            .slide-content p {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .hero-slider {
                height: 50vh;
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 32px;
                height: 32px;
            }

            .swiper-button-next::after,
            .swiper-button-prev::after {
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .hero-slider {
                height: 40vh;
            }

            .slide-content h1 {
                font-size: 2rem;
            }

            .slide-content p {
                font-size: 1rem;
            }

            .slide-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }
        }

        /* Override any framework conflicts */
        .hero-slider * {
            box-sizing: border-box;
        }

        .hero-slider .swiper-wrapper {
            width: 100%;
            height: 100%;
        }

        .hero-slider .swiper-slide {
            flex-shrink: 0;
            width: 100%;
            height: 100%;
            position: relative;
            transition-property: transform;
        }

        /* Ensure no Bootstrap container conflicts */
        .hero-slider .container,
        .hero-slider .container-fluid {
            max-width: none;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        /* Force full width for slider section */
        .hero-slider {
            width: 100vw !important;
            max-width: 100vw !important;
            margin-left: calc(-50vw + 50%) !important;
            margin-right: calc(-50vw + 50%) !important;
        }

        /* Ensure touch events work properly */
        .hero-slider {
            touch-action: pan-y pinch-zoom;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .swiper-slide {
            touch-action: pan-y pinch-zoom;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Ensure swiper container is properly sized */
        .hero-swiper {
            width: 100% !important;
            height: 100% !important;
            overflow: hidden;
        }

        /* Fix any potential z-index issues */
        .swiper-wrapper {
            z-index: 1;
        }

        .swiper-slide {
            z-index: 1;
        }
    </style>
</head>

<body>


    <!-- Main Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-light py-3">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('shop.index') }}">
                    <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan Logo">
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Main Navigation -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('shop.index') }}">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" href="#" id="categoriesDropdown"
                                role="button" data-bs-toggle="dropdown">Categories</a>
                            <ul class="dropdown-menu">
                                @foreach($categories->take(8) as $category)
                                <li>
                                    <a class="dropdown-item" href="{{ route('shop.category', $category->id) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#new-arrivals">New Arrivals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="#best-sellers">Best Sellers</a>
                        </li>
                    </ul>

                    <!-- Search Bar -->
                    <div class="search-container mx-4">
                        <form action="{{ route('shop.search') }}" method="GET" class="d-flex">
                            <input type="text" name="q" class="form-control"
                                placeholder="Search products..." value="{{ request('q') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <!-- User Actions -->
                    <div class="d-flex align-items-center">
                        <a href="{{ route('shop.cart') }}" class="nav-icon">
                            <i class="fas fa-shopping-cart"></i>
                            @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                            @endif
                        </a>

                        @auth
                        <div class="dropdown">
                            <a href="#" class="nav-icon dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        <div class="d-flex align-items-center gap-2 ms-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-3 py-2">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm px-3 py-2">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Slider -->
    @if($sliders->isNotEmpty())
    <section class="hero-slider">
        
        <div class="swiper hero-swiper">
            <div class="swiper-wrapper">
                @foreach($sliders as $index => $slider)
                <div class="swiper-slide" data-slide-index="{{ $index }}">
                    @if($slider->image)
                    @php
                        $isAbsolute = Str::startsWith($slider->image, ['http://', 'https://']);
                        $src = $isAbsolute ? $slider->image : asset($slider->image);
                        $version = $slider->updated_at ? ('?v=' . $slider->updated_at->timestamp) : '';
                    @endphp
                    <img src="{{ $src }}{{ $version }}" alt="{{ $slider->title }}" loading="lazy" class="slider-image">
                    @else
                    <div class="slide-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); position: absolute; top: 0; left: 0; z-index: 1;"></div>
                    @endif
                    <div class="slide-overlay"></div>
                    <div class="slide-content animate__animated animate__fadeInUp">
                        <h1>{{ $slider->title }}</h1>
                        @if($slider->description)
                        <p>{{ $slider->description }}</p>
                        @endif
                        @if($slider->button_text && $slider->button_link)
                        <a href="{{ $slider->button_link }}" class="slide-btn">{{ $slider->button_text }}</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @if($sliders->count() > 1)
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            @endif
        </div>
    </section>
    @else
    <section class="hero-slider" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white;">
        <div style="text-align: center;">
            <h1>No Sliders Found</h1>
            <p>Please add some sliders in the admin panel</p>
        </div>
    </section>
    @endif

    <!-- Value Proposition -->
    <section class="value-prop">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <h5>Free Shipping</h5>
                        <p class="text-muted mb-0">Free shipping on orders over ৳ 5000</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-undo-alt"></i>
                        </div>
                        <h5>Easy Returns</h5>
                        <p class="text-muted mb-0">7 day hassle free returns for a full refund</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Secure Payment</h5>
                        <p class="text-muted mb-0">100% secure payment processing</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="value-item">
                        <div class="value-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted mb-0">Round-the-clock customer service</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    @if($featuredCategories->isNotEmpty())
    <section class="featured-categories">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Shop by Category</h2>
                <p class="section-subtitle">Discover our wide range of products across different categories</p>
            </div>
            <div class="row g-4">
                @foreach($featuredCategories as $category)
                <div class="col-lg-3 col-md-6">
                    <a href="{{ route('shop.category', $category->id) }}" class="text-decoration-none">
                        <div class="category-card">
                            @if($category->image)
                            <img src="{{ asset($category->image) }}" alt="{{ $category->name }}">
                            @endif
                            <div class="category-overlay">
                                <div class="category-title">{{ $category->name }}</div>
                                <div class="category-count">{{ $category->products->count() }} Products</div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Featured Products -->
    @if($featuredProducts->isNotEmpty())
    <section class="product-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Featured Products</h2>
                <p class="section-subtitle">Handpicked products just for you</p>
            </div>
            <div class="row g-4">
                @foreach($featuredProducts as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('shop.product', $product->id) }}" class="d-block">
                                @if($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                @endif
                            </a>
                            <div class="product-badge">Featured</div>
                        </div>
                        <div class="product-info">
                            <h6 class="product-title"><a href="{{ route('shop.product', $product->id) }}" class="text-decoration-none text-dark">{{ Str::limit($product->name, 50) }}</a></h6>
                            <div class="product-price">@money($product->price)</div>
                            <div class="product-actions">
                                @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart w-100">
                                        <i class="fas fa-cart-plus"></i>
                                        <span class="ms-1">Add to Cart</span>
                                    </button>
                                </form>
                                <a href="{{ route('shop.checkout') }}?product={{ $product->id }}&quantity=1" class="btn-buy-now w-100">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @else
                                <button class="btn-add-cart w-100" disabled>
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">Out of Stock</span>
                                </button>
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-buy-now w-100 disabled" aria-disabled="true" tabindex="-1">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @endif
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-view-details">
                                    <span>View details</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- New Arrivals -->
    @if($newArrivals->isNotEmpty())
    <section id="new-arrivals" class="product-section bg-light">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">New Arrivals</h2>
                <p class="section-subtitle">Check out our latest products</p>
            </div>
            <div class="row g-4">
                @foreach($newArrivals as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('shop.product', $product->id) }}" class="d-block">
                                @if($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                @endif
                            </a>
                            <div class="product-badge">New</div>
                        </div>
                        <div class="product-info">
                            <h6 class="product-title"><a href="{{ route('shop.product', $product->id) }}" class="text-decoration-none text-dark">{{ Str::limit($product->name, 50) }}</a></h6>
                            <div class="product-price">@money($product->price)</div>
                            <div class="product-actions">
                                @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart w-100">
                                        <i class="fas fa-cart-plus"></i>
                                        <span class="ms-1">Add to Cart</span>
                                    </button>
                                </form>
                                <a href="{{ route('shop.checkout') }}?product={{ $product->id }}&quantity=1" class="btn-buy-now w-100">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @else
                                <button class="btn-add-cart w-100" disabled>
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">Out of Stock</span>
                                </button>
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-buy-now w-100 disabled" aria-disabled="true" tabindex="-1">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @endif
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-view-details">
                                    <span>View details</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Best Sellers -->
    @if($bestSellers->isNotEmpty())
    <section id="best-sellers" class="product-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Best Sellers</h2>
                <p class="section-subtitle">Most popular products among our customers</p>
            </div>
            <div class="row g-4">
                @foreach($bestSellers as $product)
                <div class="col-lg-3 col-md-6">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ route('shop.product', $product->id) }}" class="d-block">
                                @if($product->image && file_exists(public_path($product->image)))
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                                    <i class="fas fa-image fa-3x text-muted"></i>
                                </div>
                                @endif
                            </a>
                            <div class="product-badge">Best Seller</div>
                        </div>
                        <div class="product-info">
                            <h6 class="product-title"><a href="{{ route('shop.product', $product->id) }}" class="text-decoration-none text-dark">{{ Str::limit($product->name, 50) }}</a></h6>
                            <div class="product-price">@money($product->price)</div>
                            <div class="product-actions">
                                @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn-add-cart w-100">
                                        <i class="fas fa-cart-plus"></i>
                                        <span class="ms-1">Add to Cart</span>
                                    </button>
                                </form>
                                <a href="{{ route('shop.checkout') }}?product={{ $product->id }}&quantity=1" class="btn-buy-now w-100">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @else
                                <button class="btn-add-cart w-100" disabled>
                                    <i class="fas fa-ban"></i>
                                    <span class="ms-1">Out of Stock</span>
                                </button>
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-buy-now w-100 disabled" aria-disabled="true" tabindex="-1">
                                    <i class="fas fa-bolt"></i>
                                    <span>Buy Now</span>
                                </a>
                                @endif
                            </div>
                            <div class="mt-2">
                                <a href="{{ route('shop.product', $product->id) }}" class="btn-view-details">
                                    <span>View details</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif





    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section footer-brand-wrap">
                        <h5>E-Dukan</h5>
                        <p class="footer-brand">Your premier destination for online shopping. Quality products, great prices, exceptional service.</p>
                        <div class="social-icons mt-3">
                            <a href="https://facebook.com/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="https://instagram.com/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="https://linkedin.com/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5>Shop</h5>
                        <a href="{{ route('shop.index') }}" class="footer-link">Home</a>
                        <a href="{{ route('shop.category') }}" class="footer-link">Categories</a>
                        <a href="#new-arrivals" class="footer-link">New Arrivals</a>
                        <a href="#best-sellers" class="footer-link">Best Sellers</a>
                        <a href="{{ route('shop.cart') }}" class="footer-link">Cart</a>
                        @auth
                        <a href="{{ route('shop.profile') }}" class="footer-link">My Account</a>
                        @endauth
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h5>Support</h5>
                        <a href="{{ route('support.info') }}" class="footer-link">Support Info</a>
                        <a href="{{ route('support.returns') }}" class="footer-link">Returns Policy</a>
                        <a href="tel:+18001234567" class="footer-link">Call Us: +1 800 123 4567</a>
                        <a href="mailto:support@edukan.com" class="footer-link">Email: support@edukan.com</a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="footer-section">
                        <h5>Policy</h5>
                        <a href="{{ route('policy.privacy') }}" class="footer-link">Privacy Policy</a>
                        <a href="{{ route('policy.terms') }}" class="footer-link">Terms of Service</a>
                        <a href="{{ route('policy.cookies') }}" class="footer-link">Cookie Policy</a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="footer-section text-center">
                        <h5>We Accept</h5>
                        <div class="payment-icons">
                            <span class="payment-badge">Cash on Delivery</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color:#1f2937; opacity:.6;">

            <div class="row py-3" style="border-top: 1px solid #1f2937;">
                <div class="col-12">
                    <p class="mb-0 text-center" style="color:#9ca3af;">&copy; 2025 E-Dukan. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    
    <!-- Fallback Swiper JS if CDN fails -->
    <script>
        function initHeroSlider() {
            const slides = document.querySelectorAll('.hero-swiper .swiper-slide');
            if (!slides || slides.length === 0) return;

            const hasMultiple = slides.length > 1;
            new Swiper('.hero-swiper', {
                loop: hasMultiple,
                autoplay: hasMultiple ? { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true } : false,
                effect: 'slide',
                speed: 700,
                slidesPerView: 1,
                spaceBetween: 0,
                pagination: hasMultiple ? { el: '.swiper-pagination', clickable: true, dynamicBullets: true } : false,
                navigation: hasMultiple ? { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' } : false,
                allowTouchMove: true,
                grabCursor: true,
            });
        }

        (function() {
            const ensureSwiper = () => {
                if (typeof Swiper === 'undefined') {
                    const script = document.createElement('script');
                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.js';
                    script.onload = initHeroSlider;
                    document.head.appendChild(script);
                } else {
                    initHeroSlider();
                }
            };

            document.addEventListener('DOMContentLoaded', ensureSwiper);

            // Smooth scrolling for anchor links
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            e.preventDefault();
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                });
            });

            // Add to cart feedback
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-add-cart').forEach(button => {
                    button.addEventListener('click', function() {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-check me-1"></i>Added!';
                        setTimeout(() => { this.innerHTML = originalText; }, 1800);
                    });
                });
            });
        })();
    </script>
</body>

</html>
