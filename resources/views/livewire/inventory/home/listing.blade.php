<div id="home-listing">

    <nav class="toolbox sticky-toolbox sticky-content fix-top">
        <div class="toolbox-left">
            <h2 class="title mb-0 pt-0 pb-2">Products</h2>
        </div>
        <div class="toolbox-right">
            <div class="toolbox-item toolbox-sort select-box text-dark">
                <label>Show Entries :</label>
                <select name="" class="form-control show-entries" wire:model="limit">
                    <option value="50">50</option>
                    <option value="80">80</option>
                    <option value="100">100</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                </select>
            </div>
        </div>
    </nav>

    <div class="row grid banner-product-wrapper mb-6">
        @foreach($inventories as $index =>$inventory)
            <div class="grid-item col-xl-5col col-lg-3 col-sm-4 col-6">
                @include('web.inventories.single_inventory')
            </div>
        @endforeach

    </div>
    <!-- End of Banner Product Wrapper -->

    {{ $inventories->links() }}

    @include('livewire.includes.screen_loader')
</div>
