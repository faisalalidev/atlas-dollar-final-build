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
                              action="{{ route(config('constants.WEB_PREFIX') . 'forgot_password_request') }}">
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
                            <button type="submit"
                                    class="btn btn-primary">Send Email
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection

