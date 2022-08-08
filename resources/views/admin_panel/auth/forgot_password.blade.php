<!DOCTYPE HTML>
<html lang="en">

@include('admin_panel.auth.layouts.head' , ['page_title' => 'Forgot Password'])

<body>

<b class="screen-overlay"></b>

<main class="vh-100 d-flex">

    <section class="content-main align-self-center login-card">

        <div class="card shadow mx-auto">
            @include('admin_panel.includes.flash_messages')

            <div class="card-body">
                <h4 class="card-title mb-4">Forgot Password</h4>
                <form action="{{ route('admin_forgot_password_request') }}"
                      onsubmit="submitButton.disabled = true; return true;" method="post">
                    @csrf
                    <div class="mb-3">
                        <input id="email" name="email" type="text" class="form-control" value=""
                               placeholder="Email">
                        @include('admin_panel.includes.single_flash',['input_name' => 'email'])
                    </div> <!-- form-group// -->

                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary w-100"> Reset </button>
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
