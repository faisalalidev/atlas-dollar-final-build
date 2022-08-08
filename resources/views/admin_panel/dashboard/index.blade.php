@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title"> Dashboard </h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Inventory <span
                                class="date-holder">{{ $inventories_synced ? date('m/d/Y',strtotime($inventories_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $inventories_synced ? $inventories_synced->page_size : 0}}</span><span> / {{ $inventories_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($inventory_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_inventory_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif

                    </div>
                </div> <!-- card  end// -->
            </div>
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Categories <span
                                class="date-holder">{{ $category_synced ? date('m/d/Y',strtotime($category_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $category_synced_count }}</span><span> / {{ $category_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($category_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_category_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif
                    </div>
                </div> <!-- card  end// -->
            </div>
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Inventory Images<span
                                class="date-holder">{{ $inventory_images_synced ? date('m/d/Y',strtotime($inventory_images_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $inventory_images_synced ? $inventory_images_synced->page_size : 0 }}</span><span> / {{ $inventories_images_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($images_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_inventory_images_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Inventory Changes<span
                                class="date-holder">{{ $inventory_changes_synced ? date('m/d/Y',strtotime($inventory_changes_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $inventory_changes_synced ? $inventory_changes_synced->page_size : 0 }}</span><span> / {{ $inventories_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($changes_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_inventory_changes_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Customers<span
                                class="date-holder">{{ $stores_synced ? date('m/d/Y',strtotime($stores_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $stores_synced ? $stores_synced->page_size : 0 }}</span><span> / {{ $stores_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($stores_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_stores_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card card-body mb-4">
                    <div class="text">
                        <h6 class="mb-1">Invoices<span
                                class="date-holder">{{ $invoices_changes_synced ? date('m/d/Y',strtotime($invoices_changes_synced->created_at)) : '-' }}</span>
                        </h6>
                        <span
                            class="text-large">{{ $invoices_changes_synced ? $invoices_changes_synced->page_size : 0 }}</span><span> / {{ $invoices_count }}</span>
                    </div>
                    <div class="mt-2">
                        @if($invoice_changes_cron_synced)
                            <a href="javascript:;" class="btn btn-success">Syncing
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        @else
                            <a href="javascript:;"
                               onclick="syncData($(this) , '{{ route('admin_invoice_changes_sync_now') }}')"
                               class="btn btn-primary">Sync Now</a>
                        @endif
                    </div>
                </div> <!-- card  end// -->
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Latest orders</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td><b>{{ $order->user->name }}</b></td>
                                <td>{{ $order->store->name }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td class="text-end">
                                    <div class="dropdown float-end">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light btn-sm"> <i
                                                class="material-icons md-more_horiz"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            @if(hasPermission($orders_module , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_view'))
                                                <a class="dropdown-item"
                                                   href="{{ route('admin_'.$orders_module.'_view' , ['id' => $order->id]) }}">View
                                                    detail</a>
                                            @endif
                                            @if($order->txt_file_path)
                                                <a class="dropdown-item" href="{{ asset($order->txt_file_path) }}"
                                                   download>Download File</a>
                                            @endif
                                            <a class="dropdown-item"
                                               href="{{ route('admin_'.$orders_module.'_re_mail' , ['id' => $order->id]) }}"
                                               onclick="return confirm('Are you sure?')">Re Email</a>

                                            @if(hasPermission($orders_module , auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->role_slug , 'can_delete'))
                                                <a class="dropdown-item text-danger"
                                                   href="{{ route('admin_'.$orders_module.'_delete', ['id' => $order->id]) }}"
                                                   onclick="return confirm('Are you sure?')">Delete</a>
                                            @endif
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('extra-scripts')

    <script>

        function syncData(elm, url) {

            if (elm.hasClass('btn-success')) {
                return;
            }

            elm.text('Syncing');

            elm.removeClass('btn-primary');
            elm.addClass('btn-success');

            elm.append('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span></div>')

            $.get(url).done(function () {
                console.log('Syncing request sent')
            }).fail(function (error) {
                console.log('Error while making a sync request', error)
            })
        }

    </script>
@endpush

