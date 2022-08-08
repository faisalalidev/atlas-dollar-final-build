@extends('admin_panel.main')

@section('page_title' , $page_title)

@push('extra-css')
    <link href="{{ asset('admin_assets/vendors/bower_components/dropify/dist/css/dropify.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('main_content')

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Edit {{ $page_title }}</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
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
                                <form
                                    action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update',['id' => $data->id]) }}"
                                    method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Title</label>
                                                <input type="text" value="{{ $data->description }}" id="description"
                                                       name="description" class="form-control"
                                                       placeholder="Title">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'description'])
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">SKU</label>
                                                <input type="text" value="{{ $data->part_number }}" id="part_number"
                                                       name="part_number" class="form-control" required
                                                       placeholder="SKU">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'part_number'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon"><i class="ti-money"></i></div>
                                                    <input type="number" class="form-control" id="price" name="price"
                                                           required
                                                           value="{{ !empty($data->prices->toArray()) ? $data->prices[0]->regular : 0 }}"
                                                           placeholder="Price">
                                                </div>
                                                @include('admin_panel.includes.single_flash',['input_name' => 'price'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Supplier</label>
                                                <input type="text" value="{{ $data->supplier_part_number }}"
                                                       id="supplier_part_number" required
                                                       name="supplier_part_number" class="form-control"
                                                       placeholder="Supplier">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'supplier_part_number'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Min Limit</label>
                                                <input type="text" value="{{ $data->size1 }}" id="size1"
                                                       name="size1" class="form-control"
                                                       placeholder="Min Limit">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'size1'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Max Limit</label>
                                                <input type="text" value="{{ $data->weight }}" id="weighti"
                                                       name="weight" class="form-control"
                                                       placeholder="Max Limit">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'weight'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Unit Size</label>
                                                <input type="text" value="{{ $data->size3 }}" id="size3"
                                                       name="size3" class="form-control"
                                                       placeholder="Unit Size">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'size3'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Quantity</label>
                                                <input type="text" value="{{ $data->in_stock }}" id="in_stock"
                                                       name="in_stock" class="form-control"
                                                       placeholder="Quantity">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'in_stock'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Category</label>
                                                <select type="text" id="sub_category" name="sub_category"
                                                        class="form-control">
                                                    @foreach($categories as $category)
                                                        <option
                                                            {{ $data->sub_category == $category->category_number ? 'selected' : '' }}
                                                            value="{{ $category->category_number }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @include('admin_panel.includes.single_flash',['input_name' => 'sub_category'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Description</label>
                                                <textarea id="description2"
                                                          name="description2" class="form-control"
                                                          placeholder="Description">{{ $data->description2 }}</textarea>
                                                @include('admin_panel.includes.single_flash',['input_name' => 'description2'])
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label mb-10">Status</label>
                                                <div class="radio-list">
                                                    <div class="radio-inline pl-0">
                                                        <div class="radio radio-info">
                                                            <input
                                                                {{ strtolower($data->status) == 'publish' ? 'checked' : '' }} type="radio"
                                                                name="status"
                                                                value="publish" id="radio1">
                                                            <label for="radio1">Published</label>
                                                        </div>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <div class="radio radio-info">
                                                            <input
                                                                {{ strtolower($data->status) == 'draft' ? 'checked' : '' }} type="radio"
                                                                name="status"
                                                                value="draft" id="radio2">
                                                            <label for="radio2">Draft</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('admin_panel.includes.single_flash',['input_name' => 'status'])

                                            </div>
                                        </div>

                                    </div>

                                    <div class="seprator-block"></div>
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
                                    <div class="seprator-block"></div>
                                    <div class="form-actions">
                                        <button type="submit"
                                                class="btn btn-success btn-icon left-icon mr-10 pull-left"><i
                                                class="fa fa-check"></i> <span>save</span></button>
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

@endsection

@push('extra-scripts')
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

        });
    </script>
@endpush
