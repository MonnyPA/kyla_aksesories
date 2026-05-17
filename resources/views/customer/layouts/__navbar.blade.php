        <div class="container-fluid fixed-top">
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="#" class="navbar-brand"><h1 class="text-primary display-6">Kyla Aksesoris</h1></a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            @if(Auth::user()->role->role_name == 'owner')
                            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('orders.index') }}" class="nav-item nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">Daftar Penjualan</a>
                            <a href="{{ route('products.index') }}" class="nav-item nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Kelola Product</a>
                            <a href="{{ route('categories.index') }}" class="nav-item nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Kelola Category</a>
                            <a href="{{ route('roles.index') }}" class="nav-item nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">Kelola Role</a>
                            <a href="{{ route('users.index') }}" class="nav-item nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">Kelola User</a>
                            @endif

                            @if(Auth::user()->role->role_name == 'admin')
                            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('listproduct') }}" class="nav-item nav-link {{ request()->routeIs('listproduct') ? 'active' : '' }}">Penjualan Product</a>
                            <a href="{{ route('orders.index') }}" class="nav-item nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">Daftar Penjualan</a>
                            <a href="{{ route('products.index') }}" class="nav-item nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Kelola Product</a>
                            <a href="{{ route('categories.index') }}" class="nav-item nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">Kelola Category</a>
                            @endif

                            @if(Auth::user()->role->role_name == 'cashier_kd' || Auth::user()->role->role_name == 'cashier_osm')
                            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                            <a href="{{ route('listproduct') }}" class="nav-item nav-link {{ request()->routeIs('listproduct') ? 'active' : '' }}">Penjualan Product</a>
                            <a href="{{ route('orders.index') }}" class="nav-item nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">Daftar Penjualan</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                @csrf
                                <a href="{{ route('logout') }}" class="nav-item nav-link">
                                    <span>{{ __('Log Out') }}</span>
                                </a>
                            </form>

                        </div>
                        @if(Auth::user()->role->role_name == 'cashier_kd' || Auth::user()->role->role_name == 'cashier_osm')
                        <div class="d-flex m-3 me-0">
                            <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                            </a>
                        </div>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

        <!-- Single Page Header start -->
        @php
            $title = 'Kyla Aksesories';
            $subtitle = 'Selamat Datang';

            if(Route::currentRouteName() == 'product')
            {
                $title = 'Product Kami';
                $subtitle = 'Silakan pilih sesuai keinginan anda';
            }

            elseif(Route::currentRouteName() == 'cart')
            {
                $title = 'Keranjang Belanja';
                $subtitle = 'Periksa product pilihan anda';
            }

            elseif(Route::currentRouteName() == 'checkout')
            {
                $title = 'Checkout';
                $subtitle = 'Selesaikan pesanan anda';
            }
        @endphp

        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">{{ $title }}</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item active text-primary">{{ $subtitle }}</li>
            </ol>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item active text-warning">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</li>
            </ol>

        </div>
        <!-- Single Page Header End -->
