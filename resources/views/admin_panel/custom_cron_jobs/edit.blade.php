@extends('admin_panel.main')

@section('page_title' , $page_title)
@push('extra-css')
    <link
        href="{{ asset('admin_assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ asset('admin_assets//vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"
          rel="stylesheet" type="text/css"/>

@endpush
@section('main_content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Edit {{ $module_add_title }} - Current Time ({{ \Illuminate\Support\Carbon::now().' '.(\Carbon\Carbon::now())->timezone->getName() }})</h5>
            </div>
            <!-- Breadcrumb -->
        {{--<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index-2.html">Dashboard</a></li>
                <li><a href="#"><span>e-commerce</span></a></li>
                <li class="active"><span>add-products</span></li>
            </ol>
        </div>--}}
        <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form method="post"
                                      action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update',['id' => $data->id]) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Name</label>
                                                <input type="text" disabled class="form-control" name=""
                                                       placeholder="Full Name"
                                                        value="{{ $data->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label mb-10"
                                                   for="exampleFormControlInput2">Time</label>
                                            <div class='input-group date' id='datetimepicker2'>
                                                <input onkeydown="return false" value="" name="time_to_execute"
                                                       type='text' class="form-control"/>
                                                <span class="input-group-addon">
																	<span class="fa fa-clock-o"></span>
																</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-actions">
                                        <button type="submit"
                                                class="btn btn-success btn-icon left-icon mr-10 pull-left"><i
                                                class="fa fa-check"></i> <span>Update</span></button>
                                        <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_show') }}"
                                           type="button" class="btn btn-warning pull-left">Cancel</a>
                                        <div class="clearfix"></div>
                                    </div>
                                </form>
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
@push('extra-scripts')
    <script src="{{ asset('admin_assets/vendors/bower_components/moment/min/moment-with-locales.min.js') }}"></script>
    <script
        src="{{ asset('admin_assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('admin_assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>

        $('#datetimepicker2').datetimepicker({
            format: 'LT',
            useCurrent: false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
        }).data("DateTimePicker").date('{{ $data->time_to_execute }}');

    </script>
@endpush


