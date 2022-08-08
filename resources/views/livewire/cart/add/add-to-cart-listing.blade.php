<div>
    @switch($btn_type)

        @case('list')
        <div class="product-qty-form mt-2">
            <div class="input-group">
                <input class="form-control" value="0" type="number" min="0" id="add-to-cart-txt-{{ $inventory_id }}"
                       onkeyup="changeQuantityFromJavascript($(this),true)"
                       max="10000000">
                <button class="w-icon-plus" onclick="incrementQuantityFromJavascript($(this),true,true)"></button>
                <button class="w-icon-minus" onclick="decrementQuantityFromJavascript($(this),true,true)"></button>
            </div>
        </div>
        <div class="add-to-cart mt-2">
            <a class="btn {{ $added_to_cart ? 'btn-success' : 'btn-primary' }} add-to-cart"
               id="add-to-cart-list-{{ $inventory_id }}" data-list-inventory-id="{{ $inventory_id }}"
               @if($quantity) onclick="addToCartFromJavascript($(this))" @endif
               title="Add to Cart">
                <i class="w-icon-cart"></i>
                <span>Add to Cart</span>
                @if($added_to_cart) ({{$quantity_added}}) <i
                    class="ml-1 w-icon-check-solid"></i>
                @endif
            </a>
        </div>
        @break

        @default

        <div class="product-form">
            <div class="product-qty-form">
                <div class="input-group">
                    <input class="form-control" value="0" type="number" min="0"
                           onkeyup="changeQuantityFromJavascript($(this))"
                           max="10000000">
                    <button class="w-icon-plus" onclick="incrementQuantityFromJavascript($(this))"></button>
                    <button class="w-icon-minus" onclick="decrementQuantityFromJavascript($(this))"></button>
                </div>
            </div>
            <button class="btn btn-primary add-to-cart" onclick="addToCartFromJavascript($(this),true)">
                <i class="w-icon-cart"></i>
                <span>Add to Cart</span>
            </button>
        </div>

        @break

    @endswitch
</div>
