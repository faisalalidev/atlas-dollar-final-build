<div class="mobile-menu-wrapper">
    <div class="mobile-menu-overlay"></div>
    <!-- End of .mobile-menu-overlay -->

    <a href="{{ route(config('constants.WEB_PREFIX').'home') }}" class="mobile-menu-close"><i
            class="close-icon"></i></a>
    <!-- End of .mobile-menu-close -->

    <div class="mobile-menu-container scrollable">
        <div class="tab-content">
            <ul class="mobile-menu">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route(config('constants.WEB_PREFIX').'shop',['category_name' => $category->name]) }}">
                            {{ $category->name }}
                        </a>
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
                @endforeach
            </ul>
        </div>
    </div>
</div>
