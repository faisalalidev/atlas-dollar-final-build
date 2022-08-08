@if(count($small_banners))
    <div class="swiper-container swiper-theme category-banner-3cols pt-10 pb-10"
         data-swiper-options="{
                    'spaceBetween': 20,
                    'slidesPerView': 1,
                    'breakpoints': {
                        '576': {
                            'slidesPerView': 2
                        },
                        '992': {
                            'slidesPerView': 3
                        }
                    }
                }">
        <div class="swiper-wrapper row cols-lg-3 cols-sm-2 cols-1">
            @foreach($small_banners as $small_banner)
                <div class="swiper-slide banner banner-fixed category-banner br-sm">
                    <figure>
                        <img
                            src="{{ asset($small_banner->image) }}"
                            alt="Category Banner" width="447"
                            height="230" style="background-color: #cfd1cf;"/>
                    </figure>
                    {!! $small_banner->text !!}
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
@else
    <br>
    <br>
@endif
