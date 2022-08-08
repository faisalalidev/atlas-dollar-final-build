@extends('admin_panel.main')

@section('page_title' , $page_title)

@push('extra-css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/bower_components/summernote/dist/summernote.css') }}" />
    <link href="{{ asset('admin_assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <form method="post" enctype="multipart/form-data"
              action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update',['id' => $data->id]) }}">
        @csrf
            <div class="content-header">
                <h2 class="content-title">Edit {{ $module_add_title }}</h2>
                <div>
                    <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_show') }}"
                       class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Type</label>
                                        <select class="form-control" name="type"
                                                required>
                                            <option
                                                {{ $data->type == 'small_banner' ? 'selected' : '' }} value="small_banner">
                                                Small Banner
                                            </option>
                                            <option
                                                {{ $data->type == 'full_banner' ? 'selected' : '' }} value="full_banner">
                                                Full Banner
                                            </option>
                                        </select>
                                        @include('admin_panel.includes.single_flash',['input_name' => 'name'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Text</label>
                                        <textarea class="form-control summernote" name="text" required
                                                  placeholder="Type">{{ $data->text }}</textarea>
                                        @include('admin_panel.includes.single_flash',['input_name' => 'text'])
                                    </div>
                                </div>
                            </div>

                            <h6 class="txt-dark capitalize-font"><i
                                    class="zmdi zmdi-collection-image mr-10"></i>upload image</h6>
                            <hr class="light-grey-hr"/>
                            <div class="row">
                                <div class="col-sm-12 ol-md-12 col-xs-12">
                                    <div class="form-group mb-4">

                                        <input type="file"
                                               id="input-file-now-custom"
                                               class="dropify" name="photo"
                                               data-default-file="{{ asset($data->display_image) }}"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>
    </section>

@endsection

@push('extra-scripts')
    <script src="{{ asset('admin_assets/vendors/bower_components/summernote/dist/summernote.min.js') }}"></script>

    <script src="{{ asset('admin_assets/vendors/bower_components/dropify/dist/js/dropify.min.js') }}"></script>

    <script type="text/javascript">

        $(function () {
            "use strict";

            $('.summernote').summernote({height: 150});

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

        });
    </script>
@endpush
