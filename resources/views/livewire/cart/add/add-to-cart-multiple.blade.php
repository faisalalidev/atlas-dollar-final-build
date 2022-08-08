<a id="scroll-plus" class="scroll-plus show" href="javascript:;" onclick="addToCartAll('{{ json_encode($add_to_cart_wire_id) }}')"
   title="Add product" role="button">
    <i class="w-icon-plus">
        @if($quantity)
            <span class="plus-products-count">{{ $quantity }}</span>
        @endif
    </i>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
    </svg>
</a>
