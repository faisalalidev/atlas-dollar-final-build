<div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
    <div class="cart-overlay"></div>
    <a href="#" class="cart-toggle label-down link">
        <i class="w-icon-cart">
            <span class="cart-count">{{ count($items) }}</span>
        </i>
        <span class="cart-label">Cart</span>
    </a>
    <div class="dropdown-box">
        <div class="cart-header">
            <span>Shopping Cart</span>
            <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
        </div>
        <div class="perfect-scroll-bar" id="perfect-scroll-bar">
            @foreach($items as $index => $item)
                @php
                    $inventory = $item->inventory;
                @endphp
                <div class="products">
                    <div class="product product-cart">
                        <div class="product-detail">
                            <a href="#" class="product-name btn-quickview"
                               data-selector="{{ 'header-cart-'.$inventory->inventory_id }}">{{ $item->inventory->description }}</a>
                            <div class="price-box">
                                <span class="product-quantity">{{ $item->quantity }}</span>
                                <span class="product-price">{{ isset($item->inventory->prices[0]) ? $item->inventory->prices[0]->regular : $item->inventory->price }}</span>
                            </div>
                        </div>
                        <figure class="product-media">
                            <a href="#" class="btn-quickview"
                               data-selector="{{ 'header-cart-'.$inventory->inventory_id }}">
                                <img style="height: 95px;"
                                     src="{{ asset($item->inventory->display_image) }}"
                                     onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                     alt="product" height="84"
                                     width="94"/>
                            </a>
                        </figure>
                        <button class="btn btn-link btn-close btn-cart-close"
                                onclick="$(this).addClass('load-more-overlay loading'); $(this).attr('disabled',true)"
                                id="btn-cart-close{{ $item->id }}"
                                wire:click="removeProductFromCart({{ $item->id }})" aria-label="button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @include('web.inventories.view',['list_type' => 'header-cart-'])

            @endforeach
        </div>

        @if(!count($items))
            <h4>No product in your cart.</h4>
        @endif
        <div class="cart-footer">
            <div class="cart-total">
                <label>Subtotal:</label>
                <span class="price">{{ addCurrencyToPrice($total_amount) }}</span>
            </div>
            <div class="cart-action">
                <a href="{{ route(config('constants.WEB_PREFIX').'cart') }}" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                <a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}" class="btn btn-primary  btn-rounded">Checkout</a>
            </div>
        </div>
    </div>
    <!-- End of Dropdown Box -->

    <script>

        window.addEventListener('cartItemRemoved', event => {

            if ($('.cart-dropdown').hasClass('opened')){
                $('.cart-toggle').trigger('click');
            }

            let data = event.detail;

            $('#add-to-cart-list-'+data.inventory.inventory_id).removeClass('btn-success')

            $('#add-to-cart-list-'+data.inventory.inventory_id).addClass('btn-primary')

            $('#add-to-cart-list-'+data.inventory.inventory_id).html('<i class="w-icon-cart"></i> <span>Add to Cart</span>')


            $('.perfect-scroll-bar').perfectScrollbar();

            Wolmart.Minipopup.open({
                productClass: "product-cart",
                name: data.inventory.description,
                nameLink: "javascript:;",
                imageSrc: base_url + '/' + data.inventory.display_image,
                imageLink: '#',
                message: "<p>has been removed from your cart:</p>",
                actionTemplate: '<a href="' + base_url+'/cart' + '" class="btn btn-rounded btn-sm">View Cart</a><a href="' + base_url +'/checkout'+ '" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
            })

        })

        window.addEventListener('cartItemAdded', event => {

            let data = event.detail;

            if ($('.cart-dropdown').hasClass('opened')){
                $('.cart-toggle').trigger('click');
            }

            $('.add-to-cart').removeClass('load-more-overlay loading')

            $('#add-to-cart-txt-'+data.inventory.inventory_id).val(0)

            $('.perfect-scroll-bar').perfectScrollbar();

            Wolmart.Minipopup.open({
                productClass: "product-cart",
                name: data.inventory.description,
                nameLink: "javascript:;",
                imageSrc: base_url + '/' + data.inventory.display_image,
                imageLink: '#',
                message: "<p>has been added to your cart:</p>",
                actionTemplate: '<a href="' + base_url+'/cart' + '" class="btn btn-rounded btn-sm">View Cart</a><a href="' + base_url + '/checkout' + '" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
            })

        })

    </script>
</div>

