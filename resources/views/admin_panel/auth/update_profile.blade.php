@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <form method="post" enctype="multipart/form-data"
              action="{{ route(config('constants.ADMIN_PREFIX') .'update_profile_request') }}">
            @csrf
            <div class="content-header">
                <h2 class="content-title">Update Profile</h2>
                <div>
                    <a href="javascript:;" onclick="history.go(-1)"
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
                                               for="exampleFormControlInput2">Full Name</label>
                                        <input type="text" class="form-control"
                                               name="name"
                                               placeholder="Full Name"
                                               required
                                               value="{{ auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->name }}">
                                        @include('admin_panel.includes.single_flash' , ['input_name' => 'name'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Email</label>
                                        <input type="email" class="form-control"
                                               name="email"
                                               placeholder="email"
                                               required
                                               value="{{ auth()->guard(config('constants.ADMIN_GUARD_NAME'))->user()->email }}">
                                        @include('admin_panel.includes.single_flash' , ['input_name' => 'email'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">New Password</label>
                                        <input type="password" class="form-control"
                                               name="password" id="password"
                                               placeholder="Leave empty if you dont want to change it"
                                               onfocus="if (this.hasAttribute('readonly')) {
    this.removeAttribute('readonly');
    // fix for mobile safari to show virtual keyboard
    this.blur();    this.focus();  }"
                                               value="">
                                        @include('admin_panel.includes.single_flash' , ['input_name' => 'password'])
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="control-label mb-10"
                                               for="exampleFormControlInput2">Confirm Password</label>
                                        <input type="password" class="form-control"
                                               name="password_confirmation" id="c_password"
                                               placeholder="Leave empty if you dont want to change it"
                                               onfocus="if (this.hasAttribute('readonly')) {
    this.removeAttribute('readonly');
    // fix for mobile safari to show virtual keyboard
    this.blur();    this.focus();  }"
                                               value="">
                                        @include('admin_panel.includes.single_flash' , ['input_name' => 'password_confirmation'])
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

