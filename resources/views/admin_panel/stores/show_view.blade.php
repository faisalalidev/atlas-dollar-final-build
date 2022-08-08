<input type="checkbox" {{ $row->active ? 'checked' : '' }}
onchange="changeStatus($(this),'{{ route('admin_store_status',['id' => $row->id]) }}')"/>
