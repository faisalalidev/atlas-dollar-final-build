<div class="product product-single product-popup" data-selector="{{ $list_type.$inventory->inventory_id }}"
     data-index="{{ $index }}">
    <div class="row gutter-lg">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="product-gallery product-gallery-sticky">
                <div class="swiper-container product-single-swiper swiper-theme nav-inner">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        @if(count($inventory->images))
                            @foreach($inventory->images as $image)
                                <div class="swiper-slide">
                                    <figure class="product-image">
                                        <img src="{{ asset('files/'.$image->image) }}"
                                             onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                             data-zoom-image="{{ asset($image->image) }}"
                                             alt="{{ $inventory->description }}" width="800" style="height: 393px">
                                    </figure>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <figure class="product-image">
                                    <img src="{{ asset($inventory->display_image) }}"
                                         onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                         data-zoom-image="{{ asset($inventory->display_image) }}"
                                         alt="{{ $inventory->description }}" width="800" height="900">
                                </figure>
                            </div>
                        @endif
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
                <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                        'navigation': {
                            'nextEl': '.swiper-button-next',
                            'prevEl': '.swiper-button-prev'
                        }
                    }">
                    <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                        @if(count($inventory->images))
                            @foreach($inventory->images as $image)
                                <div class="product-thumb swiper-slide">
                                    <img src="{{ asset('files/'.$image->image) }}"
                                         onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                         alt="Product Thumb" width="100">
                                </div>
                            @endforeach
                        @else
                            <div class="product-thumb swiper-slide">
                                <img src="{{ asset($inventory->display_image) }}"
                                     onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                     alt="Product Thumb" width="100">
                            </div>
                        @endif
                    </div>
                    <button class="swiper-button-next"></button>
                    <button class="swiper-button-prev"></button>
                </div>
            </div>
        </div>
        <div class="col-md-6 overflow-hidden p-relative">
            <div class="product-details scrollable pl-0">
                <h2 class="product-title" data-index="{{ $index }}"
                    data-selector="{{ $list_type.$inventory->inventory_id }}">{{ $inventory->description }}</h2>
                <div class="product-bm-wrapper">
                    <ul class="product-meta">
                        <li>Category: <strong><a href="#">{{ $inventory->category->name }}</a></strong></li>
                        <li>SKU: <strong>{{ $inventory->part_number }}</strong></li>
                        <li>UNIT PRICE: <strong>{{ $inventory->price }}</strong></li>
                        <li>REGULAR PRICE: <strong>${{ isset($inventory->prices[0]) ? $inventory->prices[0]->regular : 0 }}</strong></li>
                        <li>MIN LIMIT: <strong>1</strong></li>
                        <li>MAX LIMIT: <strong>0</strong></li>
                        <li>UNIT SIZE: <strong>{{ $inventory->size3 }}</strong></li>
                        <li>AVAILABLE: <strong>{{ $inventory->in_stock }}</strong></li>
                    </ul>
                </div>

                <hr class="product-divider">

                <div class="product-price">{{ $inventory->price }}</div>

                <div class="product-short-desc">
                    <ul class="list-type-check list-style-none">
                        @if($inventory->description2)
                            <li>{{ $inventory->description2 }}</li>
                        @endif
                    </ul>
                </div>

                <hr class="product-divider">

                @if(auth(config('constants.WEB_GUARD_NAME'))->check() && $inventory->in_stock > 0)
                    @livewire('cart.add.add-to-cart-listing', ['inventory_id' =>
                    $inventory->inventory_id,'type' => 'view'],key('view'.$inventory->inventory_id))
                @endif
            </div>
        </div>
    </div>
</div>
