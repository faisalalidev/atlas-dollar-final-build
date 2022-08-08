<section id="right">
    <form class="panel cart" wire:submit.prevent="updateCart(Object.fromEntries(new FormData($event.target)))">
        <div class="panel-header list-header cart-header">
            <div class="qty">Qty</div>
            <div class="bo-title">Product</div>
            <div class="price">Price</div>
            <div class="total">Total</div>
            <div class="action">&nbsp;</div>
        </div>
        <div class="panel-body list cart-list">
            <ul id="cart-products-list">
                @if(!count($items))
                    <tr>
                        <td><h3 class="no-product-found">No Products in your cart</h3></td>
                    </tr>
                @endif
                @foreach($items as $index => $item)
                    @php
                        $inventory = $item->inventory;
                    @endphp
                    <li class="simple cart-item-{{ $item->id }}" style="">
                        <div class="list-item cart-item">
                            <div class="list-row">
                                <div class="qty">
                                    <div class="product-qty-form mt-2">
                                        <div class="input-group">
                                            <input class="quantity form-control" name="quantity-{{ $item->id }}"
                                                   value="{{ $item->quantity }}" type="number" min="0"
                                                   max="100000">
                                            <button type="button" class="w-icon-plus"
                                                    onclick="incrementQuantityFromJavascriptBulkOrder($(this))"></button>
                                            <button type="button" class=" w-icon-minus"
                                                    onclick="decrementQuantityFromJavascriptBulkOrder($(this))"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="bo-title"><strong
                                        data-name="title">{{ $item->inventory->description }}</strong></div>
                                <div class="price">{{ isset($item->inventory->prices[0]) ? $item->inventory->prices[0]->regular : $item->inventory->price }}</div>
                                <div
                                    class="total">{{ addCurrencyToPrice((isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $item->inventory->float_price) * $item->quantity) }}</div>
                                <div class="action"><a
                                        onclick="removeProductBulkOrder($(this),'{{ $item->id }}')"
                                        wire:click="removeProductFromCart({{ $item->id }})" data-action="remove"
                                        href="javascript:;"><i
                                            class="fa fa-times"></i></a>
                                </div>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
        <div class="list list-totals cart-totals">
            <ul>
                <li class="list-row subtotal">
                    <div class="field-label">Total Products:</div>
                    <div class="field-value">{{ count($items) }}</div>
                    <div class="field-label text-right">Subtotal:</div>
                    <div class="field-value text-right">
                                    <span class="woocommerce-Price-amount amount">
                                        <div>
                                        <span class="woocommerce-Price-currencySymbol"></span>{{ addCurrencyToPrice($total_amount) }}
                                        </div>
                                    </span>
                    </div>
                </li>
                <li class="list-row order-total">
                    <div class="field-label"></div>
                    <div class="field-value"></div>
                    <div class="field-label text-right">Order total:</div>
                    <div class="field-value text-right">
                                        <span class="woocommerce-Price-amount amount">
                                            <div><span class="woocommerce-Price-currencySymbol"></span>{{ addCurrencyToPrice($total_amount) }}</div>
                                        </span>
                    </div>
                </li>
            </ul>
        </div>

        <div class="list-actions cart-actions">
            <div class="d-flex">
                <button onclick="clearCartBulkOrder($(this))" type="button" class="btn btn-primary mr-auto"
                        data-action="void">
                    Void
                </button>

                <button wire:loading.class="load-more-overlay loading" wire:target="updateCart" type="submit"
                        class="btn btn-primary"
                        data-action="void"
                        style="margin-left: 15px;">
                    Update Cart
                </button>


                <a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}" class="btn btn-success"
                   data-action="checkout" style="margin-left: 15px;">
                    Checkout
                </a>

            </div>
        </div>
        <div class="cart-notes">
            <div style="display: none;"></div>
        </div>

    </form>
</section>
