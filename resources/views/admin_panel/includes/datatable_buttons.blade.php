<div class="dropdown float-end">
    <a href="#" data-bs-toggle="dropdown" class="btn btn-light btn-sm"> <i class="material-icons md-more_horiz"></i>
    </a>
    <div class="dropdown-menu">
        @if(in_array('view', $actions) && hasPermission($module , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_view'))
            <a class="dropdown-item" href="{{ route($buttons['view']['route'] , ['id' => $row->id]) }}">View detail</a>
        @endif

        @if(in_array('sync', $actions))
            <a class="dropdown-item" href="{{ route('admin_'.$module.'_sync' , ['id' => $row->id]) }}"
               onclick="return confirm('Are you sure?')">Sync</a>
        @endif

        @if(in_array('order_file', $actions) && $row->txt_file_path)
            <a class="dropdown-item" href="{{ asset($row->txt_file_path) }}"
               download>Download File</a>
        @endif

        @if(in_array('re_order_mail', $actions))
            <a class="dropdown-item" href="{{ route('admin_'.$module.'_re_mail' , ['id' => $row->id]) }}"
               onclick="return confirm('Are you sure?')">Re Email</a>
        @endif

        @if(in_array('invoice_pdf', $actions))
            <a class="dropdown-item" href="{{ route('admin_'.$module.'_pdf' , ['id' => $row->id]) }}">Download PDF</a>
        @endif

        @if(in_array('invoice_excel', $actions))
            <a class="dropdown-item" href="{{ route('admin_'.$module.'_excel' , ['id' => $row->id]) }}">Download Excel</a>
        @endif

        @if($module != 'user_verification_management' && $module != 'app_user_management')
            @if(in_array('edit', $actions) && hasPermission($module , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_edit'))
                <a class="dropdown-item" href="{{ route($buttons['edit']['route'] , ['id' => $row->id]) }}">Edit</a>
            @endif
        @endif

        @if(in_array('delete', $actions) && hasPermission($module , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_delete'))
            <a class="dropdown-item text-danger" href="{{ route($buttons['delete']['route'] , ['id' => $row->id]) }}"
               onclick="return confirm('Are you sure?')">Delete</a>
        @endif
    </div>
</div>
