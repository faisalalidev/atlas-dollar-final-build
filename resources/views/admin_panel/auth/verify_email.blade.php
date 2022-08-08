<!DOCTYPE HTML>
<html lang="en">

@include('admin_panel.auth.layouts.head' , ['page_title' => 'Reset Password'])

<body>

<b class="screen-overlay"></b>

<main class="vh-100 d-flex">

    <section class="content-main align-self-center login-card">

        <div class="card shadow mx-auto">
            <div class="card-body">
                <h4 class="card-title mb-4">Change Password</h4>
                <form action="{{ route('admin_forgot_password_change') }}"
                      onsubmit="submitButton.disabled = true; return true;" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-3">
                        <input id="email" name="email" type="email" class="form-control" value=""
                               placeholder="Email" required>
                        @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                    </div>

                    <div class="mb-3">
                        <input id="password" name="password" type="text" class="form-control" value=""
                               placeholder="Password" required>
                        @include('admin_panel.includes.single_flash',['input_name' => 'password'])
                    </div> <!-- form-group// -->

                    <div class="mb-3">
                        <input id="password_confirmation" name="password_confirmation" type="text" class="form-control" value=""
                               placeholder="Confirm Password" required>
                        @include('admin_panel.includes.single_flash',['input_name' => 'password_confirmation'])
                    </div> <!-- form-group// -->

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100"> Reset Password </button>
                    </div> <!-- form-group// -->
                </form>


            </div> <!-- card-body.// -->
        </div> <!-- card .// -->


        <!-- ============================ COMPONENT LOGIN  END.// ================================= -->




    </section> <!-- content-main end// -->
</main>

@include('admin_panel.auth.layouts.scripts')


</body>
</html>
