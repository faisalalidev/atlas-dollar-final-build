<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg"></p>
            </div>

            <div class="header-right">
                @if(auth(config('constants.WEB_GUARD_NAME'))->check())
                    <a href="{{ route(config('constants.WEB_PREFIX').'account') }}" class="d-lg-show">My Account</a>
                @else
                    <a href="{{ route(config('constants.WEB_PREFIX').'login') }}?login=true" class=""><i
                            class="w-icon-account"></i>Sign In</a>
                    <span class="delimiter">/</span>
                    <a href="{{ route(config('constants.WEB_PREFIX').'login') }}?register=true" class="">Register</a>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Header Top -->
    <div class="sticky-content fix-top sticky-header">
        <div class="header-middle">
            <div class="container">
                <div class="header-left mr-md-4">
                    <a href="#"
                       class="mobile-menu-toggle w-icon-hamburger" aria-label="menu-toggle">
                    </a>
                    <a href="{{ route(config('constants.WEB_PREFIX').'home') }}" class="logo ml-lg-0">
                        <img src="{{ asset($app_settings['logo']) }}"
                             alt="logo" width="144" height="45"/>
                    </a>
                    <livewire:header.search/>
                </div>
                <div class="header-right ml-4">
                    <div class="header-call d-xs-show d-lg-flex align-items-center">
                        <a href="tel:#" class="w-icon-call"></a>
                        <div class="call-info d-lg-show">
                            <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                <a href="tel:{{ $app_settings['phone'] }}" class="text-capitalize">Call Now</a></h4>
                            <a href="tel:{{ $app_settings['phone'] }}"
                               class="phone-number font-weight-bolder ls-50">{{ $app_settings['phone'] }}</a>
                        </div>
                    </div>
                    <livewire:cart.listing.header/>
                </div>
            </div>
        </div>
        <!-- End of Header Middle -->

        <!-- For mobile -->
{{--        <div>--}}
{{--            <livewire:header.search/>--}}
{{--        </div>--}}

        <div class="header-bottom has-dropdown">
            <div class="container">
                <div class="inner-wrap">
                    <div class="header-left">
                        <div
                            class="dropdown category-dropdown has-border {{ !isset($close_dropdown) ? '' : ''  }}"
                            data-visible="true">
                            <a href="#" class="category-toggle text-white text-capitalize" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                               data-display="static" title="Browse Categories">
                                <i class="w-icon-category"></i>
                                <span>Shop By Department</span>
                            </a>

                            <div class="dropdown-box text-default">
                                <ul class="menu vertical-menu category-menu">

                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route(config('constants.WEB_PREFIX').'shop',['category_name' => $category->name]) }}">
                                                {{ $category->name }}
                                            </a>
                                            <ul class="megamenu">
                                                <li>
                                                    <ul>
                                                        @foreach($category->childs as $child)
                                                            @if(!empty($child->inventories))
                                                                <li>
                                                                    <a href="{{ route(config('constants.WEB_PREFIX').'shop',['category_name' => $child->name]) }}">{{ $child->name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach

                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route(config('constants.WEB_PREFIX').'shop') }}"
                                           class="font-weight-bold text-uppercase ls-25">
                                            View All Categories<i class="w-icon-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <nav class="main-nav">
                            <ul class="menu">
                                <li class="{{ \Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Route::currentRouteName() , 'home') ? 'active' : '' }}">
                                    <a href="{{ route(config('constants.WEB_PREFIX').'home') }}">Home</a>
                                </li>

                                <li class="{{ \Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Route::currentRouteName() , 'shop') ? 'active' : '' }}">
                                    <a href="{{ route(config('constants.WEB_PREFIX').'shop') }}">Shop</a>
                                </li>

                                <li class="{{ \Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Route::currentRouteName() , 'products') ? 'active' : '' }}">
                                    <a href="{{ route(config('constants.WEB_PREFIX').'products') }}">New Products</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    @if(auth(config('constants.WEB_GUARD_NAME'))->check())
                        <div class="header-right">
                            <a href="#bulk-order" class="d-xl-show bulk-order-popup">Bulk Order</a>
                            <a href="{{ route(config('constants.WEB_PREFIX').'quick_order') }}">Quick Order</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
