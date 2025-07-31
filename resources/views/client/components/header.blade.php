<header class="tf-header style-4">
    <div class="header-top">
        <div class="container-full-2">
            <div class="row align-items-center">
                <div class="col-md-4 col-3 d-xl-none">
                    <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu">
                        <span></span>
                    </a>
                </div>
                <div class="col-xl-4 d-none d-xl-block">
                    <div class="box-support-online">
                        <i class="icon icon-phone"></i>
                        <span class="br-line type-vertical"></span>
                        <div class="sp-wrap">
                            <span class="text-small">Online support</span>
                            <a href="tel:4055550128" class="phone-number h4 fw-semibold link">0981675396</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-6">
                    <a href="index.html" class="logo-site justify-content-center">
                        <img src="{{asset('build/assets/images/logo-tamjr.png')}}" alt="Logo">
                    </a>
                </div>
                <div class="col-xl-4 col-md-4 col-3">
                    <ul class="nav-icon-list">
                        <li class="d-none d-lg-flex">
                            <a class="nav-icon-item link" href="login.html"><i class="icon icon-user"></i></a>
                        </li>
                        <li class="d-none d-md-flex">
                            <a class="nav-icon-item link" href="#search" data-bs-toggle="modal">
                                <i class="icon icon-magnifying-glass"></i>
                            </a>
                        </li>
                        <li class="d-none d-sm-flex">
                            <a class="nav-icon-item link" href="wishlist.html"><i class="icon icon-heart"></i></a>
                        </li>
                        <li class="shop-cart" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                            <a class="nav-icon-item link" href="#shoppingCart" data-bs-toggle="offcanvas">
                                <i class="icon icon-shopping-cart-simple"></i>
                            </a>
                            <span class="count">24</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-inner bg-black d-none d-xl-block">
                <div class="container">
                    <nav class="box-navigation style-white">
                        @include('client.components.menu')
                    </nav>
                </div>
            </div>
</header>
<header class="tf-header header-fixed">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 col-3 d-xl-none">
                        <a href="#mobileMenu" data-bs-toggle="offcanvas" class="btn-mobile-menu">
                            <span></span>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6 text-center text-xl-start">
                        <a href="index.html" class="logo-site justify-content-center justify-content-xl-start">
                            <img src="images/logo/logo.svg" alt="Logo">
                        </a>
                    </div>
                    <div class="col-xl-6 d-none d-xl-block">
                        <nav class="box-navigation">
                            @include('client.components.menu')
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon-list">
                            <li class="d-none d-lg-flex">
                                <a class="nav-icon-item link" href="login.html"><i class="icon icon-user"></i></a>
                            </li>
                            <li class="d-none d-md-flex">
                                <a class="nav-icon-item link" href="#search" data-bs-toggle="modal">
                                    <i class="icon icon-magnifying-glass"></i>
                                </a>
                            </li>
                            <li class="d-none d-sm-flex">
                                <a class="nav-icon-item link" href="wishlist.html"><i class="icon icon-heart"></i></a>
                            </li>
                            <li class="shop-cart" data-bs-toggle="offcanvas" data-bs-target="#shoppingCart">
                                <a class="nav-icon-item link" href="#shoppingCart" data-bs-toggle="offcanvas">
                                    <i class="icon icon-shopping-cart-simple"></i>
                                </a>
                                <span class="count">24</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
<style>
    .logo-site img {
        max-height: 48px;
        width: auto;
        transition: max-height 0.3s;
    }
    .phone-number {
        font-family: 'Montserrat', 'Arial', sans-serif;
        font-size: 1.2rem;
        color: #ff5722;
        letter-spacing: 1px;
        font-weight: 700;
        text-shadow: 0 1px 2px rgba(0,0,0,0.08);
        transition: color 0.3s;
    }
    .phone-number:hover {
        color: #e91e63;
        text-decoration: underline;
    }
</style> 