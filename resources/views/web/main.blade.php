<!DOCTYPE html>
<html lang="en">

@include('web.includes.head')
<body class="{{ isset($body_class) ? $body_class : 'home' }}">

<div class="page-wrapper">

    @include('web.includes.header')

    @yield('web_main_content')

    @include('web.includes.footer')

    <div class="modal fade" id="bulk-order" tabindex="-1" role="dialog" aria-hidden="true" style="width: 100%; height: 100%">
        <div>
            <livewire:order.bulk-order-products/>

            <livewire:order.bulk-order-cart/>
        </div>    
    </div>

</div>

@include('web.includes.sticky_mobile_footer')

<a id="scroll-top" class="scroll-top" href="demo8.html#top" title="Top" role="button"> <i class="w-icon-angle-up"></i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
        <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
    </svg>
</a>

@if(auth(config('constants.WEB_GUARD_NAME'))->check() && (getRouteName() == 'web_shop' || getRouteName() == 'web_home' || getRouteName() == 'web_products'))
    <livewire:cart.add.add-to-cart-multiple/>
@endif

@include('web.includes.mobile_menu')

@include('web.includes.scripts')

</body>

</html>
