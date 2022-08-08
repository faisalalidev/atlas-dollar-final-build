@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main login-page">
        <div class="page-content">
            <div class="container">
                <div class="login-popup">
                    @include('web.includes.flash_messages')
                    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                        <ul class="nav nav-tabs text-uppercase" role="tablist">
                            <li class="nav-item">
                                <a href="#sign-in"
                                   class="nav-link {{ ($errors->has('email') || request()->has('login')) && !$errors->has('register_email') ? 'active' : '' }}">Sign
                                    In</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab-sign-up" href="#sign-up"
                                   class="nav-link {{ $errors->has('register_email') || request()->has('register') ? 'active' : '' }}">Sign
                                    Up</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div
                                class="tab-pane {{ (($errors->has('email') || request()->has('login')) || !request()->has('register')) && !$errors->has('register_email') ? 'active' : '' }}"
                                id="sign-in">
                                <form method="post" id="login-form"
                                      action="{{ route(config('constants.WEB_PREFIX').'authentication') }}">
                                    @csrf
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
                                    <div class="form-checkbox d-flex align-items-center justify-content-between">
                                        <input type="checkbox" class="custom-checkbox" id="remember1" name="remember1">
                                        <label for="remember1">Remember me</label>
                                        <a href="{{ route(config('constants.WEB_PREFIX') . 'forgot_password') }}">Lost your password?</a>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-primary">Sign In
                                    </button>
                                </form>
                            </div>
                            <div
                                class="tab-pane {{ $errors->has('register_email') || request()->has('register') ? 'active' : '' }}"
                                id="sign-up">

                                <form method="post" id="register-form"
                                      action="{{ route(config('constants.WEB_PREFIX').'signup') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name *</label>
                                        <input type="text" class="form-control" value="{{ old('register_name') }}"
                                               name="register_name" required>
                                        @if ($errors->has('register_name'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_name') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Your email address *</label>
                                        <input type="email" class="form-control" value="{{ old('register_email') }}"
                                               name="register_email" required>
                                        @if ($errors->has('register_email'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Phone *</label>
                                        <input type="text" class="form-control" value="{{ old('register_phone') }}"
                                               name="register_phone" required>
                                        @if ($errors->has('register_phone'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_phone') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>User Type *</label>
                                        <select class="form-control"
                                                name="register_user_type" required>
                                            <option
                                                value="employee" {{ old('register_user_type') == 'employee' ? 'selected' : '' }}>Employee
                                            </option>
                                            <option
                                                value="manager" {{ old('register_user_type') == 'manager' ? 'selected' : '' }}>Manager
                                            </option>
                                        </select>
                                        @if ($errors->has('register_user_type'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_user_type') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Store *</label>
                                        <input type="text" class="form-control" value="{{ old('register_store_id') }}" placeholder="Enter your store ID"
                                               name="register_store_id" required>
                                        @if ($errors->has('register_store_id'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_store_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Password *</label>
                                        <input type="password" class="form-control" value=""
                                               name="register_password" required>
                                        @if ($errors->has('register_password'))
                                            <span style="color: red"
                                                  class="text-danger">{{ $errors->first('register_password') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Confirm Password *</label>
                                        <input type="password" class="form-control" value=""
                                               name="password_confirmation" required>
                                    </div>

                                    <p>Your personal data will be used to support your experience
                                        throughout this website, to manage access to your account,
                                        and for other purposes described in our <a href="#" class="text-primary">privacy
                                            policy</a>.</p>

                                    <button type="submit"
                                            class="btn btn-primary">Sign Up
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

