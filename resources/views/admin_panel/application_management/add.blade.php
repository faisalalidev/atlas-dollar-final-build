@extends('admin_panel.main')

@section('page_title' , $page_title)

@push('extra-css')
    <link href="{{ asset('admin_assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('admin_assets/dist/css/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
    <style>
        .icon-github {
            background: no-repeat url('../img/github-16px.png');
            width: 16px;
            height: 16px;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .accordion {
            margin-bottom:-3px;
        }

        .accordion-group {
            border: none;
        }

        .twitter-typeahead .tt-query,
        .twitter-typeahead .tt-hint {
            margin-bottom: 0;
        }

        .twitter-typeahead .tt-hint
        {
            display: none;
        }

        .tt-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 160px;
            padding: 5px 0;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid #cccccc;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
            background-clip: padding-box;
            cursor: pointer;
        }

        .tt-suggestion {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.428571429;
            color: #333333;
            white-space: nowrap;
        }

        .tt-suggestion:hover,
        .tt-suggestion:focus {
            color: #ffffff;
            text-decoration: none;
            outline: 0;
            background-color: #428bca;
        }

    </style>
@endpush

@section('main_content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">{{ $module_add_title }} Settings</h5>
            </div>
            <!-- Breadcrumb -->

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
                                <form method="post" enctype="multipart/form-data"
                                      action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_add') }}">
                                    @csrf
                                    <div class="row">
                                        @foreach($data as $item)

                                            @switch($item->input_type)

                                                @case('text')
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="control-label mb-10"
                                                               for="exampleFormControlInput2">{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}</label>
                                                        <input type="text" class="form-control"
                                                               name="{{ $item->setting_name }}"
                                                               placeholder="{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}"
                                                               required value="{{ $item->setting_value }}">
                                                    </div>
                                                </div>
                                                @break

                                                @case('tags_input')
                                                <div class="col-md-6">
                                                    <div class="form-group mb-4">
                                                        <label class="control-label mb-10"
                                                               for="exampleFormControlInput2">{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}</label>
                                                        <input type="text" class="form-control" data-role="tagsinput"
                                                               name="{{ $item->setting_name }}"
                                                               placeholder=""
                                                               required value="{{ $item->setting_value }}">
                                                    </div>
                                                </div>
                                                @break

                                                @case('image')
                                                <div class="col-sm-6 ol-md-6 col-xs-12">
                                                    <div class="form-group mb-4">
                                                        <label class="control-label mb-10"
                                                               for="exampleFormControlInput2">{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}</label>

                                                        <input type="file"
                                                               id="input-file-now-custom-{{ $item->id }}"
                                                               class="dropify"
                                                               name="{{ $item->setting_name }}"
                                                               data-default-file="{{ asset($item->setting_value) }}"/>
                                                    </div>
                                                </div>
                                                @break

                                            @endswitch

                                        @endforeach
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="form-actions">
                                            <button type="submit"
                                                    class="btn btn-success btn-icon left-icon mr-10 pull-left"><i
                                                    class="fa fa-check"></i> <span>Save</span></button>
                                            <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_show') }}"
                                               type="button" class="btn btn-warning pull-left">Cancel</a>
                                            <div class="clearfix"></div>
                                        </div>
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
    <script src="{{ asset('admin_assets/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <script type="text/javascript">

        $(function () {
            "use strict";

            console.log('here');

            /* Basic Init*/
            $('.dropify').dropify();

            /* Translated Init*/
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            /* Used events */
            //
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            });

            $('.bootstrap-tagsinput input').keydown(function( event ) {
                if ( event.which == 13 ) {
                    $(this).blur();
                    $(this).focus();
                    return false;
                }
            })

        });
    </script>
@endpush
