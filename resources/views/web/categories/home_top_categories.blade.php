<h2 class="title title-center mb-5">Top Categories Of The Month</h2>
<div class="swiper-container swiper-theme shadow-swiper pb-10"
     data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 2,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 3
                        },
                        '768': {
                            'slidesPerView': 4
                        },
                        '992': {
                            'slidesPerView': 5
                        },
                        '1200': {
                            'slidesPerView': 6
                        }
                    }
                }">
    <div class="swiper-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
        @foreach($top_categories as $top_category)
            <div class="swiper-slide category-wrap">
                <div class="category category-classic category-absolute overlay-zoom br-sm" style="height: 55px">
                    <div class="category-content">
                        <h4 class="category-name ls-normal">{{ $top_category->name }}</h4>
                        <a href="{{ route(config('constants.WEB_PREFIX').'shop',['category_name' => $top_category->name]) }}" class="btn btn-primary btn-link btn-underline">Shop Now</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="swiper-pagination"></div>
</div>
