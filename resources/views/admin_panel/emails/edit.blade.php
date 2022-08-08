@extends('admin_panel.main')

@section('page_title' , $page_title)
@push('extra-css')
    <link href="{{ asset('admin_assets/dist/css/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('main_content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Edit {{ $module_add_title }}</h5>
            </div>
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
                                                       for="exampleFormControlInput2">Title</label>
                                                <input type="text" disabled class="form-control" name=""
                                                       placeholder="Full Name"
                                                        value="{{ $data->title }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Recipients</label>
                                                <input type="text" class="form-control" data-role="tagsinput"
                                                       name="recipients"
                                                       placeholder=""
                                                       required value="{{ $data->recipients }}">
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
    <script src="{{ asset('admin_assets/dist/js/bootstrap-tagsinput.min.js') }}"></script>

    <script>

        $(function () {
            "use strict";
            $('.bootstrap-tagsinput input').keydown(function (event) {
                if (event.which == 13) {
                    $(this).blur();
                    $(this).focus();
                    return false;
                }
            })
        });

    </script>
@endpush


