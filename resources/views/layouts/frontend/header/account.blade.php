

    @auth
    <div class="header-action-icon-2">
        <a href="#">
            <img class="svgInject" alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
        </a>
        <a href="#"><span class="lable ml-0">{{ auth()->user()->name }}</span></a>
        <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
            <ul>
                @if(auth()->user()->type == 'admin')
                {{--  --}}
                <li><a href="{{ route(defaultRoute()) }}"><i class="fi fi-rs-dashboard mr-10"></i>Admin Pagelogo</a></li>
                @else
                <li><a href="#"><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
                <li><a href="{{ route('transaction') }}"><i class="fi fi-rs-box mr-10"></i>My Transaction</a></li>
                @endif
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @else
    <div class="header-action-icon-2">
        <a href="{{ route('login') }}"><span class="lable ml-0">Sign In</span></a>
    </div>
        @if (env('REGISTER') == true)
        <div class="header-action-icon-2">
            <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
        </div>
        @endif
    @endauth

    {{-- <a href="#">
        <img class="svgInject" alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
    </a>
    <a href="#"><span class="lable ml-0">Account</span></a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
        <ul>
            <li><a href="page-account.html"><i class="fi fi-rs-user mr-10"></i>My Account</a></li>
            <li><a href="page-account.html"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a></li>
            <li><a href="page-account.html"><i class="fi fi-rs-label mr-10"></i>My Voucher</a></li>
            <li><a href="shop-wishlist.html"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a></li>
            <li><a href="page-account.html"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a></li>
            <li><a href="page-login.html"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a></li>
        </ul>
    </div> --}}

