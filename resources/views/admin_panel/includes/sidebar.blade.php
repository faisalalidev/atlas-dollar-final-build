<aside class="navbar-aside" id="offcanvas_aside">
    <div class="aside-top">
        <a href="{{ route('admin_dashboard') }}" class="brand-wrap">
            <img src="{{ asset($app_settings['fav_icon']) }}" height="46" class="logo" alt="Ecommerce dashboard template">
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ \Illuminate\Support\Facades\Route::currentRouteName() == 'admin_dashboard' ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('admin_dashboard') }}"> <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            @foreach($modules as $module)
                @php
                    $module_name_snake = \Illuminate\Support\Str::snake($module->module_name);
                    $current_module_route_name = config('constants.ADMIN_PREFIX').$module->module_slug.'_show';
                @endphp
                @if(\Illuminate\Support\Facades\Route::has($current_module_route_name) && hasPermission($module->module_slug , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_view'))
                    <li class="menu-item {{ \Illuminate\Support\Str::contains(\Illuminate\Support\Facades\Route::currentRouteName() , $current_module_route_name) ? 'active' : '' }}" title="{{ $module->module_name }}">
                        <a class="menu-link"
                           href="{{ route($current_module_route_name) }}">
                            <i class="{{ $module->module_icon }}"></i>
                            <span class="text">{{ $module->module_name }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
        <hr>
        <ul class="menu-aside">
            <li class="menu-item">
                <a class="menu-link" href="{{ route('admin_settings') }}"> <i class="icon material-icons md-settings"></i>
                    <span class="text">Settings</span>
                </a>
            </li>
        </ul>
        <br>
        <br>
    </nav>
</aside>

