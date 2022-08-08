<div class="dropdown-box">
    <div class="products perfect-scroll-bar" id="perfect-scroll-bar" style="max-height: 242px;
    overflow: hidden;">

        @foreach($items as $index => $item)
            @php
                $inventory = $item->inventory;
            @endphp
            <div class="product product-cart">
                <div class="product-detail">
                    <h3 class="product-name">
                        <a href="#" class="btn-quickview"
                           data-selector="{{ 'mobile-'.$inventory->inventory_id }}">{{ $inventory->description }}</a>
                    </h3>
                    <div class="price-box">
                        <span class="product-quantity">{{ $item->quantity }}</span>
                        <span class="product-price">{{ addCurrencyToPrice(isset($item->inventory->prices[0]) ? $item->inventory->prices[0]->regular : $item->float_price) }}</span>
                    </div>
                </div>
                <figure class="product-media">
                    <a href="#" class="btn-quickview"
                       data-selector="{{ 'mobile-'.$inventory->inventory_id }}">
                        <img style="height: 100px" src="{{ asset($inventory->display_image) }}"
                             onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                             alt="product"
                             height="84" width="94"/>
                    </a>
                </figure>
                <button class="btn btn-link btn-close"
                        onclick="$(this).addClass('load-more-overlay loading'); $(this).attr('disabled',true)"
                        wire:click="$emit('cart:remove',{{ $item->id }})" aria-label="button">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @include('web.inventories.view',['list_type' => 'mobile-'])
        @endforeach

    </div>

    <div class="cart-total">
        <label>Subtotal:</label>
        <span class="price">{{ addCurrencyToPrice($total_amount) }}</span>
    </div>

    <div class="cart-action">
        <a href="{{ route(config('constants.WEB_PREFIX').'cart') }}" class="btn btn-dark btn-outline btn-rounded">View
            Cart</a>
        <a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}"
           class="btn btn-primary  btn-rounded">Checkout</a>
    </div>

    <script>

        window.addEventListener('resetScrollBar', event => {

            $('.perfect-scroll-bar').perfectScrollbar();

        })

    </script>
</div>
