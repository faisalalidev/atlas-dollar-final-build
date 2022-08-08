<div class="sticky-footer sticky-content fix-bottom">
    <a href="{{ route(config('constants.WEB_PREFIX').'home') }}" class="sticky-link active search-button">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="#" class="sticky-link mobile-menu-toggle" aria-label="menu-toggle">
        <i class="w-icon-category"></i>
        <p>Categories</p>
    </a>
    <a href="{{ route(config('constants.WEB_PREFIX').'account') }}" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="javascript:;" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <livewire:cart.listing.mobile/>
        <!-- End of Dropdown Box -->
    </div>

</div>
