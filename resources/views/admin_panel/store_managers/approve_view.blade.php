<input type="checkbox" {{ $row->approved_by_admin ? 'checked' : '' }}
onchange="changeStatus($(this),'{{ route('admin_store_manager_status',['id' => $row->id]) }}','store_managers')"/>
