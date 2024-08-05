<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="/images/logo.svg" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="btn btn-success nav-link px-4 text-white">Daftar</a>
                    </li>
                @endguest
            </ul>

            @auth
                <!-- Desktop Menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ Auth::user()->roles === 'ADMIN' ? route('admin-dashboard') : route('dashboard') }}"
                                class="dropdown-item">
                                Dashboard
                            </a>
                            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">
                                Profil Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                            @endphp
                            @if ($carts > 0)
                                <img src="/images/icon-cart-filled.svg" alt="" />
                                <div class="card-badge">{{ $carts }}</div>
                            @else
                                <img src="/images/icon-cart-empty.svg" alt="" />
                            @endif
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav d-block d-lg-none">
                    {{-- <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            Hi, {{ Auth::user()->name }}
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ Auth::user()->roles === 'ADMIN' ? route('admin-dashboard') : route('dashboard') }}"
                            class="nav-link d-inline-block">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dashboard-settings-account') }}" class="nav-link d-inline-block">
                            Profil Saya
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                            Keranjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Keluar</button>
                        </form>
                    </li>
                </ul>
            @endauth

        </div>
    </div>
</nav>