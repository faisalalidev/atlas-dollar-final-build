<a class="itemside" href="{{ route('admin_inventories_view',['id' => $row->id]) }}">
    <div class="left">
        <img src="{{ asset($row->display_image) }}" onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'" class="img-sm img-thumbnail" alt="Item">
    </div>
    <div class="info">
        <span class="font-small-gray d-block">{{ $row->part_number }}</span>
        <b>{{ $row->description ? $row->description : '-' }}</b>
    </div>
</a>
