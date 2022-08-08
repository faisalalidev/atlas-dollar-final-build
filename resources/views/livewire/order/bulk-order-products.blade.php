<section id="left">
    <div class="panel products">
        <div class="panel-header list-actions products-header">
            <div>
                <div class="input-group">
                    <div class="input-group-btn">
                        <a class="btn btn-secondary search-field-icon" wire:click="search" href="#"
                           data-toggle="dropdown">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                    <input type="text" class="form-control"
                           name="search" id="search-text"
                           placeholder="Search Products"
                           required wire:model="query"/>
                    <div wire:loading.class="load-more-overlay loading" style="padding-left: 32px;background: #fafafa;"></div>
                    <span class="input-group-btn">
                                    <a class="btn btn-secondary search-btn" wire:click="clearFilter"
                                       id="windward_search_repeat" href="#"
                                       data-action="sync"><i class="fa fa-redo"></i></a>
                                </span>
                </div>
            </div>
        </div>
        <div class="panel-header list-header products-list">
            <div class="img">Qty</div>
            <div class="bo-title">Product</div>
            <div class="available">Available</div>
            <div class="price">Total</div>
            <div class="action">&nbsp;</div>
        </div>
        <div class="panel-body list products-list list-striped" id="inventory-list">
            <div class="list-infinite">
                <div></div>
                <ul>
                    @if(!count($inventories))
                        <li class="simple">
                            <div class="list-item">
                                <div class="list-row">
                                    <div class="bo-title">
                                        <h2>The Product is currently out of stock or unavailable</h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                    @foreach($inventories as $inventory)
                        <li class="simple">
                            <div class="list-item">
                                <div class="list-row">
                                    <div class="img"><img
                                            src="{{ asset($inventory->display_image) }}"
                                            onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                            title="{{ $inventory->part_number }}"></div>
                                    <div class="bo-title">
                                        <div class="product-meta">{{ $inventory->part_number }}</div>
                                        <h2>{{ $inventory->description }}</h2>
                                        <ul class="product-meta-list">
                                            <li>Min Limit : 1</li>
                                            <li>Unit Size : {{ $inventory->size3 }}</li>
                                        </ul>
                                    </div>
                                    <div class="available">{{ $inventory->in_stock }}</div>
                                    <div class="price"> {{ isset($inventory->prices[0]) ? $inventory->prices[0]->regular : $inventory->price }}
                                    </div>
                                    <div class="action">
                                        <a onclick="$(this).addClass('load-more-overlay loading'); $(this).attr('disabled',true)"
                                           wire:click="addToCart({{ $inventory->inventory_id }})" data-action="add" href="#"><i
                                                class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="list-drawer"></div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="panel-footer products-footer" style="display: none">
            <div id="product_more_loader"><i class="fas fa-circle-notch fa-spin"></i>More Products Loading</div>
        </div>
    </div>
</section>
