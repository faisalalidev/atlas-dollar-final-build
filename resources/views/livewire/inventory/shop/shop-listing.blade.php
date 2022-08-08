<div>
    <div class="shop-content row gutter-lg">
    <!-- Start of Sidebar, Shop Sidebar -->
        <aside class="sidebar shop-sidebar left-sidebar sticky-sidebar-wrapper sidebar-fixed">
            <!-- Start of Sidebar Overlay -->
            <div class="sidebar-overlay"></div>
            <a class="sidebar-close" href="{{ url()->current() }}#"><i class="close-icon"></i></a>

            <!-- Start of Sidebar Content -->
            <div class="sidebar-content scrollable">
                <!-- Start of Sticky Sidebar -->
                <div class="sticky-sidebar">
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title"><label>All Categories</label></h3>
                        <ul class="widget-body filter-items search-ul accordion accordion-plus">
                            @foreach($categories as $category)
                                <li>
                                    <a href="#{{ $category->id }}"
                                       style="{{ $category_name == $category->name ? 'color : #0088dd' : '' }};"
                                       wire:click="$emit('selectCategory','{{ $category->name }}')" class="collapse">{{ $category->name }} ({{ $category->inventoryCount($category , true) }})</a>
                                    <div id="#{{ $category->id }}">
                                        <ul style="display: block !important;">
                                            @foreach($category->childs as $child)
                                                <li>
                                                    <a href="javascript:;"
                                                       style="{{ $category_name == $child->name ? 'color : #0088dd' : '' }};"
                                                       wire:click="$emit('selectCategory','{{ $child->name }}')">{{ $child->name }} <span class="inventory-count">({{ $category->inventoryCount($child) }})</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- End of Collapsible Widget -->

                </div>
                <!-- End of Sidebar Content -->
            </div>
            <!-- End of Sidebar Content -->
        </aside>
        <!-- End of Shop Sidebar -->

        <!-- Start of Shop Main Content -->
        <div class="main-content">
            @include('livewire.includes.screen_loader')
            <nav class="toolbox sticky-toolbox sticky-content fix-top">
                <div class="toolbox-left">
                    <div class="toolbox-item toolbox-sort select-box text-dark">
                        <label>Sort By :</label>
                        <select name="" class="form-control" wire:model="sort_by">
                            <option value="updated_at DESC">Default sorting</option>
                            <option value="created_at ASC">Sort by oldest</option>
                            <option value="created_at DESC">Sort by latest</option>
                            <option value="product_price ASC">Sort by price: low to high</option>
                            <option value="product_price DESC">Sort by price: high to low</option>
                        </select>
                    </div>
                </div>
                <div class="toolbox-right">
                    <div class="toolbox-item toolbox-show select-box">
                        <label>Show :</label>
                        <select id="limit-select" class="form-control" wire:model="limit">
                            <option value="50">50</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                        </select>
                    </div>

                </div>

            </nav>

            <div class="product-wrapper row cols-xl-4 cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                @foreach($inventories as $index =>$inventory)
                    <div class="product-wrap">
                        @include('web.inventories.single_inventory')
                    </div>
                @endforeach
            </div>

            {{ $inventories->links() }}
        </div>
    </div>
</div>
