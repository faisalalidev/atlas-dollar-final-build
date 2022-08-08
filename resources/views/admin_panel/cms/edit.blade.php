@extends('admin_panel.main')

@section('page_title' , $page_title)
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('admin_assets/vendors/bower_components/summernote/dist/summernote.css') }}"/>

@endpush
@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <form method="post"
              action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="content-header">
                <h2 class="content-title">Edit</h2>
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
                                               for="exampleFormControlInput2">Title</label>
                                        <input type="text" class="form-control" name="title"
                                               placeholder="Name" required
                                               value="{{ $data->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Text</label>
                                        <textarea class="form-control" name="html" id="editor" required
                                                  placeholder="Type">{{ $data->html }}</textarea>
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
    <script src="https://cdn.tiny.cloud/1/l205jdv8rdd7tkeqybvvcokgd689kmu47jluztfeqxgp7a18/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">

        $(function () {
            "use strict";

            tinymce.init({
                selector: 'textarea#editor',
                plugins: "code",
                height : "500"
            });

        });
    </script>
@endpush


