@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Add {{ $module_add_title }}</h5>
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
                                      action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_add') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="Name"
                                                       required value="{{ old('name') }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'name'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                       placeholder="Email" value="{{ old('email') }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                       placeholder="phone" value="{{ old('phone') }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'phone'])
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="control-label mb-10"
                                                       for="exampleFormControlInput2">Address</label>
                                                <input type="text" class="form-control" name="address"
                                                       placeholder="address" value="{{ old('address') }}">
                                                @include('admin_panel.includes.single_flash',['input_name' => 'address'])
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions">
                                        <button type="submit"
                                                class="btn btn-success btn-icon left-icon mr-10 pull-left"><i
                                                class="fa fa-check"></i> <span>Save</span></button>
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


