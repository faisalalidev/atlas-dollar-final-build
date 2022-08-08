<a class="itemside" href="{{ route('admin_inventories_view',['id' => $row->id]) }}">
    <div class="left">
        <img src="{{ asset($row->display_image) }}" onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'" class="img-sm img-thumbnail" alt="Item">
    </div>
</a>
