<div class="intro-wrapper">
    <div class="swiper-container swiper-theme pg-inner animation-slider row cols-1 gutter-no"
         data-swiper-options="{
                        'autoplay': {
                            'delay': 8000,
                            'pagination': ,  
                            'disableOnInteraction': false
                        }
                    }">
        <div class="swiper-wrapper">
            @foreach($full_banners as $index => $full_banner)
                <div class="swiper-slide banner banner-fixed intro-slide intro-slide{{ $index+1 }} br-sm"
                     style="background-image: url('{{ asset($full_banner->image) }}'); background-color: #E8EAEF;">
                    {!! $full_banner->text !!}
                </div>
            @endforeach

        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- End of Swiper Container -->
</div>
