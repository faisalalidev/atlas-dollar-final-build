<form wire:submit.prevent="searchProduct(Object.fromEntries(new FormData($event.target)))"
      class="input-wrapper header-search hs-expanded hs-round d-none d-md-flex" id="search-form">
    <div class="select-box bg-white">
        <select id="category" name="category" wire:model="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
                @foreach($category->childs as $child)
                    @if(!empty($child->inventories))
                    <option value="{{ $child->name }}">&nbsp;&nbsp;&nbsp;{{ '   '.$child->name }}</option>
                    @endif
                @endforeach
            @endforeach
        </select>
    </div>
    <input type="text" class="form-control bg-white" name="search" id="search-text"
           placeholder="Search in..."
           required
           wire:model="query" wire:keydown.enter="sendToSearchPage"/>
    <div wire:loading.class="load-more-overlay loading"></div>
    <button class="btn btn-search" type="submit"><i wire:click="sendToSearchPage" class="w-icon-search"></i>
    </button>

    @if($query)
        <div class="search-bar-html input-wrapper header-search hs-expanded hs-round d-none d-md-flex" id="search-dropdown">
            <ul class="search-dropdown">
                @if(!count($products))
                    <h4>No Data Found</h4>
                @endif
                @foreach($products as $index => $inventory)
                    <li class="row align-items-center">
                        <a class="product-search-list btn-quickview align-items-center col-xl-9 col-lg-9" href="#"
                           data-selector="{{ 'header-search-'.$inventory->inventory_id }}">
                            <figure class="product-media">
                                <img style="height: 70px; width: 70px"
                                     src="{{ asset($inventory->display_image) }}"
                                     onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                     alt="product" height="84"
                                     width="94"/>
                            </figure>
                            <div class="product-detail">
                                <span class="product-partnumber">{{ $inventory->part_number }}</span>
                                <span class="product-title">{{ $inventory->description }}</span>
                                <span class="product-price">{{ $inventory->price }}</span>
                            </div>
                        </a>
                        @if($inventory->in_stock <= 0 && !$inventory->back_order)
                            <div class="col-xl-3 col-lg-3">
                                <span class="lable-status">OUT OF STOCK</span>
                            </div>
                        @endif
                        @include('web.inventories.view',['list_type' => 'header-search-'])
                    </li>
                @endforeach
            </ul>
            <div class="panel-footer products-footer load-more-search" style="display: none;">
                <div><i class="fas fa-circle-notch fa-spin"></i>More Products Loading</div>
            </div>
        </div>
    @endif
</form>
