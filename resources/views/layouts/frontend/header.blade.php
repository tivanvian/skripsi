<header class="header-area header-style-1 header-style-5 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    @guest
                    @else
                    <div class="header-info">
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="{{ route('transaction') }}">My Order</a></li>
                        </ul>
                    </div>
                    @endguest
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('index') }}"><img src="{{asset('frontend/assets/imgs/theme/BNI_logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="#">
                            <select class="select-active" id="option_category">
                                <option>All Categories</option>
                                <option>Milks and Dairies</option>
                                <option>Wines & Alcohol</option>
                                <option>Clothing & Beauty</option>
                                <option>Pet Foods & Toy</option>
                                <option>Fast food</option>
                                <option>Baking material</option>
                                <option>Vegetables</option>
                                <option>Fresh Seafood</option>
                                <option>Noodles & Rice</option>
                                <option>Ice cream</option>
                            </select>
                            <input type="text" id="search" name="search" placeholder="Search for items...." />
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            {{-- <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Delaware</option>
                                        <option>Florida</option>
                                        <option>Georgia</option>
                                        <option>Hawaii</option>
                                        <option>Indiana</option>
                                        <option>Maryland</option>
                                        <option>Nevada</option>
                                        <option>New Jersey</option>
                                        <option>New Mexico</option>
                                        <option>New York</option>
                                    </select>
                                </form>
                            </div> --}}
                            @guest
                            @else
                                @include('layouts.frontend.header.cart')
                            @endguest
                            @if (Route::has('login'))
                                @include('layouts.frontend.header.account')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('index') }}"><img src="{{asset('frontend/assets/imgs/theme/BNI_logo.svg') }}" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>
                                <li class="hot-deals"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-hot-white.svg') }}" alt="hot deals" /><a href="{{ route('index') }}">Home</a></li>

                                <li>
                                    <a href="page-contact.html">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img src="{{asset('frontend/assets/imgs/theme/icons/icon-headphone-white.svg') }}" alt="hotline" />
                    <p>(021) 3193-1723<span style="margin-top:10px;">24/7 Support Center</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">

                        @guest
                        @else
                            @include('layouts.frontend.header.cart_mobile')
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('index') }}"><img src="{{asset('frontend/assets/imgs/theme/BNI_logo.svg')}}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            @if (Route::has('login'))
                @guest
                    <div class="mobile-header-info-wrap">
                        <div class="single-mobile-header-info">
                            <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Sign In </a>
                        </div>
                    </div>
                @else
                    <div class="mobile-header-info-wrap">
                        <div class="single-mobile-header-info d-flex">
                            <a href="#">
                                <img class="svgInject" alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                            </a>
                            <a href="#"><span class="lable ml-0">{{ auth()->user()->name }}</span></a>
                        </div>
                        <div class="single-mobile-header-info">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endguest

            @endif

            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-marker"></i> Jl. Menteng Raya No.76, Kb. Sirih, Kec. Menteng, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10340 </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>(021) 3193-1723 </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg')}}" alt="" /></a>
                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg')}}" alt="" /></a>
                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg')}}" alt="" /></a>
                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg')}}" alt="" /></a>
                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg')}}" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2023 © <a href='https://innovated.co.id' target="_blank"><strong class="text-brand">InnovateD Indonesia</strong></a> - Sistem Informasi Katalog BNI</div>
        </div>
    </div>
</div>
