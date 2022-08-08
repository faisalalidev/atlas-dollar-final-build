<div class="row gutter-lg mb-10">
    <div class="col-lg-8 pr-lg-4 mb-6">
        @if(count($items))
        <button onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                wire:click="removeSelectedItems" {{ !in_array(true , $items_selected_for_removal) ? 'disabled' : '' }} type="button" class="btn btn-rounded btn-danger">
            Remove Items
        </button>
        @endif
        <form wire:submit.prevent="updateCart(Object.fromEntries(new FormData($event.target)))">
            <div id="cart-products" style="max-height: 700px;
    overflow: auto;">
                <table class="shop-table cart-table">
                    <thead>
                    <tr>
                        @if(count($items))
                        <th class="product-check"><input type="checkbox" wire:click="selectAllItemsForRemoval"/></th>
                        @endif
                        <th class="product-name"><span>Product</span></th>
                        <th></th>
                        <th class="product-price"><span>Unit Size</span></th>
                        <th class="product-price"><span>Price</span></th>
                        <th class="product-quantity"><span>Quantity</span></th>
                        <th class="product-subtotal"><span>Subtotal</span></th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(!count($items))
                        <tr>
                            <td><h3>No Products in your cart</h3></td>
                        </tr>
                    @endif
                    @foreach($items as $index => $item)
                        @php
                            $inventory = $item->inventory;
                        @endphp
                        <tr>
                            <td><input type="checkbox" @if($items_selected_for_removal[$item->id]) checked @endif wire:click="selectItemForRemoval({{ $item->id }})"></td>
                            <td class="product-thumbnail">
                                <div class="p-relative">
                                    <a href="#" class="btn-quickview"
                                       data-selector="{{ 'list-'.$inventory->inventory_id }}">
                                        <figure>
                                            <img style="height: 100px;" src="{{ asset($inventory->display_image) }}"
                                                 onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                                 alt="product"
                                                 width="300" height="338">
                                        </figure>
                                    </a>
                                    <button type="button"
                                            onclick="$(this).addClass('load-more-overlay loading'); $(this).attr('disabled',true)"
                                            wire:click="$emit('cart:remove',{{ $item->id }})" class="btn btn-close"><i
                                            class="fas fa-times"></i></button>
                                </div>
                            </td>
                            <td class="product-name">
                                <a href="#" class="btn-quickview"
                                   data-selector="{{ 'list-'.$inventory->inventory_id }}">
                                    {{ $item->inventory->description }} (Pack size : {{ $item->inventory->pack_size ? $item->inventory->pack_size : 1  }})
                                </a>
                            </td>
                            <td class="product-price"><span class="amount">{{ $item->inventory->size3 }}</span></td>
                            <td class="product-price"><span class="amount">{{ isset($item->inventory->prices[0]) ? $item->inventory->prices[0]->regular : $item->inventory->price }}</span></td>
                            <td class="product-quantity">
                                <div class="input-group">
                                    <input class="form-control" name="quantity-{{ $item->id }}"
                                           value="{{ $item->quantity }}" type="number" min="0"
                                           max="100000">
                                    <button type="button" class="quantity-plus w-icon-plus"
                                            onclick="incrementQuantityFromJavascript($(this),false)"></button>
                                    <button type="button" class="quantity-minus w-icon-minus"
                                            onclick="decrementQuantityFromJavascript($(this),false)"></button>
                                </div>
                            </td>
                            <td class="product-subtotal">
                        <span
                            class="amount">{{ addCurrencyToPrice((isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $item->inventory->float_price) * $item->quantity) }}</span>
                            </td>

                            @include('web.inventories.view',['list_type' => 'list-'])
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="cart-action mb-6">
                <a href="{{ route(config('constants.WEB_PREFIX').'shop') }}"
                   class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                        class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                @if(count($items))
                    <button type="button" onclick="clearCart()"
                            class="btn btn-rounded btn-danger btn-clear">Clear Cart
                    </button>
                    <button type="button" onclick="saveCartPopup()"
                            class="btn btn-rounded btn-default btn-clear">Save Cart
                    </button>
                    <button type="submit" wire:loading.class="load-more-overlay loading"
                            class="btn btn-primary btn-rounded btn-update">Update Cart
                    </button>
                @endif
            </div>
        </form>


    </div>
    <div class="col-lg-4 sticky-sidebar-wrapper">
        <div class="sticky-sidebar">
            <div class="cart-summary mb-4">
                <h3 class="cart-title text-uppercase">Cart Totals</h3>
                <div class="cart-subtotal d-flex align-items-center justify-content-between">
                    <label class="ls-25">Subtotal</label>
                    <span>{{ addCurrencyToPrice($total_amount) }}</span>
                </div>
                <hr class="divider mb-6">
                <div class="order-total d-flex justify-content-between align-items-center">
                    <label>Total</label>
                    <span class="ls-50">{{ addCurrencyToPrice($total_amount) }}</span>
                </div>
                <a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}"
                   class="btn btn-block btn-icon-right btn btn-primary btn-block btn-checkout">
                    Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
            </div>
        </div>
    </div>

</div>
