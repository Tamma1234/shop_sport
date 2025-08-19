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
                                    <a href="tel:4055550128" class="phone-number h4 fw-semibold link">(098) 167-5396</a>
                                </div>
                            </div>
                        </div>
                <div class="col-xl-4 col-md-4 col-6">
                    <a href="{{ route('client.home') }}" class="logo-site justify-content-center">
                        <img style="width: -webkit-fill-available;" src="{{asset('build/assets/images/tamjr-sport.svg')}}" alt="Tamjr Sport Logo" class="main-logo">
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
                        <a href="{{ route('client.home') }}" class="logo-site justify-content-center justify-content-xl-start">
                            <img src="{{asset('build/assets/images/tamjrsport-logo.png')}}" alt="Tamjr Sport Logo" class="fixed-logo">
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
    .logo-site {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 0;
    }
    
    .logo-site img {
        width: auto;
        height: auto;
        object-fit: contain;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
        image-rendering: pixelated;
        filter: none;
        transition: all 0.3s ease;
        backface-visibility: hidden;
        transform: translateZ(0);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .main-logo {
        max-height: 100px !important;
        min-height: 80px;
        width: auto;
    }
    
    .fixed-logo {
        max-height: 80px !important;
        min-height: 60px;
        width: auto;
    }
    
    .logo-site:hover img {
        transform: scale(1.05);
    }
    
    .phone-number {
        font-family: 'Montserrat', 'Arial', sans-serif;
        font-size: 1.5rem;
        color: black;
        letter-spacing: 1px;
        font-weight: 700;
        text-shadow: 0 1px 2px rgba(0,0,0,0.08);
        transition: color 0.3s;
    }
    
    .phone-number:hover {
        color: #e91e63;
        text-decoration: underline;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1200px) {
        .main-logo {
            max-height: 90px !important;
            min-height: 70px;
        }
        
        .fixed-logo {
            max-height: 70px !important;
            min-height: 50px;
        }
    }
    
    @media (max-width: 768px) {
        .main-logo {
            max-height: 80px !important;
            min-height: 60px;
        }
        
        .fixed-logo {
            max-height: 60px !important;
            min-height: 45px;
        }
    }
    
    @media (max-width: 576px) {
        .main-logo {
            max-height: 70px !important;
            min-height: 50px;
        }
        
        .fixed-logo {
            max-height: 50px !important;
            min-height: 40px;
        }
    }
    
    /* Force logo to be sharp and clear */
    .logo-site img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: -moz-crisp-edges;
        image-rendering: crisp-edges;
        image-rendering: pixelated;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
    }
</style> 