@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main">
        <div class="container mt-md-0 mt-lg-10 mt-sm-0">

            <div class="row">
                <div class="col-lg-3 mb-4 top-best-seller">
                    <div class="widget widget-products widget-products-bordered h-100">
                        <div class="widget-body br-sm h-100">
                            <h4 class="title-sm font-weight-bolder ls-normal mb-2">Top Best Seller</h4>
                            <div class="swiper">
                                <div class="swiper-container swiper-theme nav-top" data-swiper-options="{
                                'slidesPerView': 1,
                                'spaceBetween': 20,
                                'breakpoints': {
                                    '576': {
                                        'slidesPerView': 2
                                    },
                                    '768': {
                                        'slidesPerView': 3
                                    },
                                    '992': {
                                        'slidesPerView': 1
                                    }
                                }
                            }">
                                    <div class="swiper-wrapper row cols-lg-1 cols-md-3 ">
                                        <div class="swiper-slide product-widget-wrap">
                                            @foreach($top_products1 as $index => $product)
                                                @php
                                                    $inventory = $product->inventory;
                                                @endphp
                                                <div class="product product-widget">
                                                    <figure class="product-media">
                                                        <a href="#" class="btn-quickview" data-index="{{ $index }}"
                                                           data-selector="{{ 'top-list1-'.$index.$inventory->inventory_id }}">
                                                            <img src='{{ asset($inventory->display_thumbnail_image) }}'
                                                                 alt="Product" width="105" height="118"/>
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <span
                                                            class="part-number">{{ $product->inventory->part_number }}</span>
                                                        <h4 class="product-name">
                                                            <a href="#" class="btn-quickview" data-index="{{ $index }}"
                                                               data-selector="{{ 'top-list1-'.$index.$inventory->inventory_id }}">{{ $product->inventory->description }}</a>
                                                        </h4>
                                                        <div class="product-price">
                                                            <ins
                                                                class="new-price">{{ $product->inventory->price }}</ins>
                                                        </div>
                                                    </div>
                                                    @include('web.inventories.view',['list_type' => 'top-list1-'.$index])
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="swiper-slide product-widget-wrap">
                                            @foreach($top_products2 as $index => $product)
                                                @php
                                                    $inventory = $product->inventory;
                                                @endphp
                                                <div class="product product-widget">
                                                    <figure class="product-media">
                                                        <a href="#" class="btn-quickview" data-index="{{ $index }}"
                                                           data-selector="{{ 'top-list2-'.$index.$inventory->inventory_id }}">
                                                            <img src="{{ asset($inventory->display_thumbnail_image) }}"
                                                                 onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                                                 alt="Product" width="105" height="118"/>
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <span
                                                            class="part-number">{{ $product->inventory->part_number }}</span>
                                                        <h4 class="product-name">
                                                            <a href="#" class="btn-quickview" data-index="{{ $index }}"
                                                               data-selector="{{ 'top-list2-'.$index.$inventory->inventory_id }}">{{ $product->inventory->description }}</a>
                                                        </h4>
                                                        <div class="product-price">
                                                            <ins
                                                                class="new-price">{{ $product->inventory->price }}</ins>
                                                        </div>
                                                    </div>
                                                    @include('web.inventories.view',['list_type' => 'top-list2-'.$index])
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button class="swiper-button-next"></button>
                                    <button class="swiper-button-prev"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 mb-4 popural-products order-first order-sm-first order-md-first order-lg-last">
                    @include('web.banners.full_banners')
                </div>
            </div>
        </div>

        <div class="container mt-2 pt-2" id="home_products">

            @include('web.inventories.home_inventories')

            @if(auth(config('constants.WEB_GUARD_NAME'))->check() && count($recently_viewed_products))
                <div class="title-link-wrapper mb-4 appear-animate">
                    <h2 class="title mb-0 ls-normal appear-animate pb-1">Recently Viewed</h2>
                    <a href="{{ route(config('constants.WEB_PREFIX').'shop') }}" class="font-weight-bold ls-25">
                        More Products<i class="w-icon-long-arrow-right"></i></a>
                </div>
                <div class="swiper-container swiper-theme shadow-swiper appear-animate mb-10 pb-2"
                     data-swiper-options="{
                        'spaceBetween': 20,
                        'slidesPerView': 2,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 3
                            },
                            '768': {
                                'slidesPerView': 5
                            },
                            '992': {
                                'slidesPerView': 6
                            },
                            '1200': {
                                'slidesPerView': 8,
                                'dots': false
                            }
                        }
                    }">
                    <div class="swiper-wrapper row cols-xl-8 cols-lg-6 cols-md-4 cols-2">
                        @foreach($recently_viewed_products as $index => $product)
                            @php
                                $inventory = $product->product;
                            @endphp
                            <div class="swiper-slide product-wrap mb-0">
                                <div class="product text-center product-absolute">
                                    <figure class="product-media">
                                        <a href="javascript:;" class="btn-quickview" data-index="{{ $index + 25 }}"
                                           data-selector="{{ 'view-'.$inventory->inventory_id }}">
                                            <img
                                                src="{{ $inventory->display_thumbnail_image }}"
                                                onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                                alt="{{ $inventory->description }}"
                                                width="213" height="238"
                                                style="background-color: #fff; height: 150px;"/>
                                        </a>
                                    </figure>
                                    <h4 class="product-name">
                                        <a href="javascript:;" class="btn-quickview"
                                           data-index="{{ $index + 25 }}"
                                           data-selector="{{ 'view-'.$inventory->inventory_id }}">{{ $inventory->description }}</a>
                                    </h4>
                                </div>
                            </div>
                            @include('web.inventories.view',['list_type' => 'view-'])

                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @endif

        </div>
    </main>

@endsection
