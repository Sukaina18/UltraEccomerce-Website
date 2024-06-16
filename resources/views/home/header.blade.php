{{-- header section --}}
<header id="header">
    <div id="header-wrap">
        <nav class="secondary-nav border-bottom">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-md-4 header-contact">
                        <p>Let's talk! <strong>077 780 7800</strong></p>
                    </div>
                    <div class="col-md-5 shipping-purchase text-center">
                        <p>Free shipping on a purchase value of LKR 200</p>
                    </div>
                    <div class="col-md-4 col-sm-12 user-items">
                        <ul class="d-flex justify-content-end list-unstyled">
                            <li>
                                <a href="index.html">
                                    <i class="icon icon-user"></i>
                                </a>
                            </li>
                            <li>
                                <a href="wishlist.html">
                                    <i class="icon icon-heart"></i>
                                </a>
                            </li>
                            <li class="user-items search-item pe-3">
                                <a href="#" class="search-button">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="primary-nav padding-small">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-2 col-md-2">
                        <div class="main-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/main-logo.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10">
                        <div class="navbar">
                            <div id="main-nav" class="stellarnav d-flex justify-content-end right">
                                <ul class="menu-list">
                                    <li>
                                        <a href="{{ url('/') }}" class="item-anchor active d-flex align-item-center" data-effect="Home">Home</a>
                                    </li>
                                    <li><a href="{{ url('/about') }}" class="item-anchor" data-effect="About">About</a></li>
                                    <li>
                                        <a href="{{ url('/shop') }}" class="item-anchor d-flex align-item-center" data-effect="Shop">Shop</a>
                                    </li>
                                    <li><a href="{{ url('/contact') }}" class="item-anchor" data-effect="Contact">Contact</a></li>
                                    @auth
                                        <li class="logregbutton position-relative">
                                            <a href="{{ url('mycart') }}" class="item-anchor d-flex align-item-center">
                                                Cart
                                                <i class="fa fa-shopping-cart" style="margin-right: 8px; margin-left:8px;" aria-hidden="true"></i>
                                                <span class="badge badge-pill badge-danger position-absolute cart-count">[{{ $count ?? 0 }}]</span>
                                            </a>
                                        </li>
                                    @endauth
                                    @if (Route::has('login'))
                                        @auth
                                            <li>
                                                <x-app-layout></x-app-layout>
                                            </li>
                                        @else
                                            <li class="logregbutton">
                                                <a href="{{ url('/login') }}" class="item-anchor d-flex align-item-center" data-effect="Shop">
                                                    <i class="fa fa-user" style="margin-right: 8px;"></i> Login
                                                </a>
                                            </li>
                                            <li class="logregbutton">
                                                <a href="{{ url('/register') }}" class="item-anchor d-flex align-item-center" data-effect="Shop">
                                                    <i class="fa fa-vcard" style="margin-right: 8px;"></i> Register
                                                </a>
                                            </li>
                                        @endauth
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
{{-- header section ends --}}
