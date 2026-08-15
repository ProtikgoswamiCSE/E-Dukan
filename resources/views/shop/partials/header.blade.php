@php
    $cartCount = $cartCount ?? 0;
    $navCategories = $navCategories ?? collect();
@endphp

<div class="site-header-top">
    <div class="container">
        <div class="site-header-top-inner">
            <span class="site-header-welcome">Welcome to E-Dukan!</span>
            <div class="site-header-top-links">
                @auth
                    <span>Hello, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="site-header-top-btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<header class="site-header">
    <nav class="navbar navbar-expand-lg site-navbar">
        <div class="container site-navbar-inner">
            <a class="navbar-brand site-logo" href="{{ route('shop.index') }}">
                <img src="{{ asset('images/E_Dokan.jpg') }}" alt="E-Dukan">
            </a>

            <form class="site-search" action="{{ route('shop.search') }}" method="GET" role="search">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." aria-label="Search products">
                <button type="submit" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="site-navbar-tools">
                <a href="{{ route('shop.cart') }}" class="site-icon-btn" aria-label="Shopping cart">
                    <i class="fas fa-shopping-cart"></i>
                    @if($cartCount > 0)
                        <span class="site-cart-badge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                    @endif
                </a>

                <div class="dropdown d-none d-lg-block">
                    @auth
                        <button class="site-icon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account menu">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
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
                    @else
                        <div class="site-auth-btns">
                            <a href="{{ route('login') }}" class="btn btn-outline-success btn-sm">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success btn-sm">Register</a>
                        </div>
                    @endauth
                </div>

                <button class="navbar-toggler site-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavbar" aria-controls="siteNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="siteNavbar">
                <ul class="navbar-nav site-nav-links">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}" href="{{ route('shop.index') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="siteCategoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="siteCategoriesDropdown">
                            @forelse($navCategories as $navCategory)
                                <li>
                                    <a class="dropdown-item" href="{{ route('shop.category', $navCategory->id) }}">
                                        {{ $navCategory->name }}
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item-text text-muted">No categories</span></li>
                            @endforelse
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}#new-arrivals">New Arrivals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}#best-sellers">Best Sellers</a>
                    </li>
                </ul>

                <div class="site-mobile-account d-lg-none">
                    @auth
                        <a class="nav-link" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                        <a class="nav-link" href="{{ route('user.orders') }}"><i class="fas fa-box me-2"></i>My Orders</a>
                        <a class="nav-link" href="{{ route('user.profile') }}"><i class="fas fa-user me-2"></i>Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-start w-100"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                        </form>
                    @else
                        <div class="d-flex gap-2 px-2 pb-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-success flex-fill">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success flex-fill">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
