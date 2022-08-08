<!DOCTYPE HTML>
<html lang="en">

@include('admin_panel.auth.layouts.head' , ['page_title' => 'Login'])

<body>

<b class="screen-overlay"></b>

<main class="vh-100 d-flex">

    <section class="content-main align-self-center login-card">

        <div class="card shadow mx-auto">
            <div class="card-body">
                <h4 class="card-title mb-4">Sign in</h4>
                <form action="{{ route('admin_authentication') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" name="email" id="email" placeholder="Username or email" type="text">
                        @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                    </div> <!-- form-group// -->
                    <div class="mb-3">
                        <input class="form-control" placeholder="Password" name="password" id="password" type="password">
                    </div> <!-- form-group// -->

                    <div class="mb-3">
                        <a href="{{ route('admin_forgot_password') }}" class="float-end">Forgot password?</a>
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input" checked="">
                            <span class="form-check-label">Remember</span>
                        </label>
                    </div> <!-- form-group form-check .// -->
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100"> Login </button>
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
