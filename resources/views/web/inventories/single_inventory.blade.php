<div>
    <div class="product product-image-gap product-simple">
        <figure class="product-media">
            <a href="#" class="btn-quickview" onclick="addToRecentlyViewed('{{ $inventory->id }}')"
               data-index="{{ $index }}" data-selector="{{ 'list-'.$inventory->inventory_id }}">
                <img
                    onerror="this.onerror=null;this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                    src='{{  asset($inventory->display_thumbnail_image) }}'
                    style="height: 200px"
                    alt="Product" width="500"
                    height="500"/>
            </a>
            <div class="product-action">
                <a href="#" class="btn-product btn-quickview" onclick="addToRecentlyViewed('{{ $inventory->id }}')"
                   data-index="{{ $index }}" data-selector="{{ 'list-'.$inventory->inventory_id }}" title="Quick View">Quick
                    View</a>
            </div>
        </figure>
        <div class="product-details">
            <div class="product-text">{{ $inventory->part_number }}</div>
            <h4 class="product-name"><a href="#" class="btn-quickview"
                                        onclick="addToRecentlyViewed('{{ $inventory->id }}')" data-index="{{ $index }}"
                                        data-selector="{{ 'list-'.$inventory->inventory_id }}"
                                        title="{{ $inventory->description }}">{{ $inventory->description }}</a>
            </h4>

            <ul class="sold-by">
                <li>Unit Price: <span>{{ $inventory->price }}</span></li>
                <li>Regular Price: <span>${{ isset($inventory->prices[0]) ? $inventory->prices[0]->regular : 0 }}</span>
                </li>
                <li>Min Limit: <span>1</span></li>
                <li>Max Limit: <span>0</span></li>
                <li>Unit Size: <span>{{ $inventory->size3 }}</span></li>
                <li>Available: <span>{{ $inventory->in_stock }}</span></li>
            </ul>
            @if(auth(config('constants.WEB_GUARD_NAME'))->check())
                @livewire('cart.add.add-to-cart-listing', ['inventory_id' =>
                $inventory->inventory_id,'type' => 'list'],key('list'.$inventory->inventory_id))
            @endif
        </div>
    </div>


    @include('web.inventories.view',['list_type' => 'list-'])

</div>
