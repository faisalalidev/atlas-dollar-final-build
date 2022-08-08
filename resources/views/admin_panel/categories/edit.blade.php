@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
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
                                                       for="exampleFormControlInput2">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="Full Name"
                                                       required value="{{ $data->name }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'name'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Type</label>
                                                <input type="text" class="form-control" name="type_name"
                                                       placeholder="Type" value="{{ $data->type_name }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'type_name'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Parent Category</label>
                                                <select class="form-control" name="parent">
                                                    <option value="">Select Parent Category</option>
                                                    @foreach($categories as $category)
                                                        <option
                                                            {{ $data->parent == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @include('admin_panel.includes.single_flash',['input_name' => 'parent'])
                                            </div>
                                        </div>
                                    </div>

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


