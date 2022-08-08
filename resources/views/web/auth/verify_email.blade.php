@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main login-page">
        <div class="page-content">
            <div class="container">
                <div class="login-popup">
                    @include('web.includes.flash_messages')
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        <form method="post" id="login-form"
                              action="{{ route(config('constants.WEB_PREFIX') . 'forgot_password_change') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label>Username or email address *</label>
                                <input type="text" class="form-control" name="email"
                                       {{ old('email') }} required>
                                @if ($errors->has('email'))
                                    <span style="color: red"
                                          class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-0">
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span style="color: red"
                                          class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group mb-0">
                                <label>Confirm Password *</label>
                                <input type="password" class="form-control" name="password_confirmation" required>
                                @if ($errors->has('password_confirmation'))
                                    <span style="color: red"
                                          class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                            <br>
                            <button type="submit"
                                    class="btn btn-primary">Change Password
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

