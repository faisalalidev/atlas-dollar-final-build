@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')
    <!--  BEGIN CONTENT AREA  -->
    <div class="container-fluid">

        <!-- Title -->
        <div class="col-sm-12">
            <div class="row heading-bg">
                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="txt-dark">{{ $page_title }} - Current Time ({{ \Illuminate\Support\Carbon::now().' '.(\Carbon\Carbon::now())->timezone->getName() }})</h4>
                </div>
                <!-- Breadcrumb -->

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    @include('admin_panel.includes.datatable' , [
                                'module_name' => $module_name,
                                'ajax_data_url' => route($module_ajax_listing_url),
                                'module_columns' => $primary_dt_columns
                            ])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!--  END CONTENT AREA  -->
@endsection


