@extends('admin_panel.main')

@section('page_title' , $page_title)

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
                                               for="exampleFormControlInput2">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Full Name"
                                               required value="{{ $data->name }}">
                                        @include('admin_panel.includes.single_flash',['input_name' => 'name'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Email</label>
                                        <input type="email" name="email" required class="form-control"
                                               placeholder="Email Address" value="{{ $data->email }}">
                                        @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone"
                                               required value="{{ $data->phone }}">
                                        @include('admin_panel.includes.single_flash',['input_name' => 'phone'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Status</label>
                                        <select class="form-select" name="approved_by_admin" required>
                                            <option value="1" {{ $data->approved_by_admin ? 'selected' : '' }}>
                                                Approved
                                            </option>
                                            <option value="0" {{ !$data->approved_by_admin ? 'selected' : '' }}>Not
                                                Approved
                                            </option>
                                        </select>
                                        @include('admin_panel.includes.single_flash',['input_name' => 'approved_by_admin'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Password</label>
                                        <input type="password" class="form-control" name="password"
                                               placeholder="password"
                                               value="">
                                        @include('admin_panel.includes.single_flash',['input_name' => 'password'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Store</label>
                                        <select class="form-select" name="store_id" required>

                                            @foreach($stores as $store)
                                                <option
                                                    value="{{ $store->customer_id }}" {{ $data->store_id == $store->customer_id ? 'selected' : '' }}>
                                                    {{ $store->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @include('admin_panel.includes.single_flash',['input_name' => 'store_id'])
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


