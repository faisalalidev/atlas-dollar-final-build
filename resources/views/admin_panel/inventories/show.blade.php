@extends('admin_panel.main')

@section('page_title' , $page_title)

@push('extra-css')
    <link href="{{ asset('admin_assets/vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@section('main_content')

    <section class="content-main">

        <div class="content-header">
            <h2 class="content-title">{{ $page_title }}</h2>
        </div>


        <div class="card mb-4 p-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label mb-10">Category</label>
                            <select id="sub_category" name="sub_category"
                                    class="form-select">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option
                                        {{ old('sub_category') == $category->category_number ? 'selected' : '' }}
                                        value="{{ $category->category_number }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label mb-10">Stock Status</label>
                            <select id="stock" name="stock"
                                    class="form-select">
                                <option value="">Both</option>
                                <option value="in_stock">In Stock</option>
                                <option value="out_of_stock">Out Of Stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label mb-10">Status</label>
                            <select id="status" name="status"
                                    class="form-select">
                                <option value="">All Status</option>
                                <option value="publish">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container" style="margin-top:10px;">
                @include('admin_panel.includes.datatable' , [
                                'module_name' => $module_name,
                                'ajax_data_url' => route($module_ajax_listing_url),
                                'module_columns' => $primary_dt_columns
                            ])
            </div>
        </div>

    </section>
@endsection

@push('extra-scripts')
    <script src="{{ asset('admin_assets/vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">

        let table_url = '{{ route($module_ajax_listing_url) }}';

        $(function () {
            $('.select2').select2();
        })

        $('#sub_category').on('change', function () {

            tableUrl()
        })

        $('#status').on('change', function () {

            tableUrl()
        })

        $('#stock').on('change', function () {

            tableUrl()
        })

        function tableUrl() {

            table.ajax.url(table_url + '?sub_category=' + $('#sub_category').val() + '&status=' + $('#status').val() + '&stock=' + $('#stock').val()).load();

            table.draw();
        }

    </script>
@endpush
