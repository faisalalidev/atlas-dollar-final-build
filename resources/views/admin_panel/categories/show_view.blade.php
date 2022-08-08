<input type="checkbox" {{ $row->active ? 'checked' : '' }}
onchange="changeStatus($(this),'{{ route('admin_category_status',['id' => $row->id]) }}')"/>
