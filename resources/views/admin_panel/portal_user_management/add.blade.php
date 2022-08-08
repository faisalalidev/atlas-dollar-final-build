@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <form method="post"
              action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_add') }}">
            @csrf
            <div class="content-header">
                <h2 class="content-title">Add {{ $module_add_title }}</h2>
                <div>
                    <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_show') }}"
                       class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                                           required value="{{ old('name') }}">
                                    @include('admin_panel.includes.single_flash',['input_name' => 'name'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="control-label mb-10"
                                           for="exampleFormControlInput2">Email</label>
                                    <input type="email" name="email" required class="form-control"
                                           placeholder="Email Address" value="{{ old('email') }}">
                                    @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="control-label mb-10"
                                           for="exampleFormControlInput2">Role</label>
                                    <select class="form-select" name="role_slug" required>
                                        @foreach($portal_roles as $portal_role)
                                            <option
                                                {{ old('role_slug') == $portal_role->role_slug ? 'selected' : '' }} value="{{ $portal_role->role_slug }}">
                                                {{ $portal_role->role_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('admin_panel.includes.single_flash',['input_name' => 'role_slug'])
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-4">
                                    <label class="control-label mb-10"
                                           for="exampleFormControlInput2">Password</label>
                                    <input type="password" name="password" required class="form-control"
                                           placeholder="password" value="{{ old('password') }}">
                                    @include('admin_panel.includes.single_flash',['input_name' => 'password'])
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


