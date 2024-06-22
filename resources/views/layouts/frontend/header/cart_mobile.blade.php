<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="#">
        <img alt="Nest" src="{{asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
        <span class="pro-count blue cartCount"></span>
    </a>
    <a href="#"><span class="lable">Cart</span></a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2" >
        <div class="d-flex justify-content-between">
            <h5 class="mb-0">Shopping Cart (<span class="pro-count blue cartCount"></span>)</h5>
            <a href="{{ route('product.getCartDetail') }}" class="outline">View cart</a>
        </div>

        <ul id="listCartMoblie" class="overflow-auto mt-4" style="max-height: 300px;">
        </ul>

    </div>
</div>
