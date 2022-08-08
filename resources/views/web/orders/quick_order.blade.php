@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main">
        <!-- End of Breadcrumb -->
        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div id="quick-order">
                            <livewire:order.quick-order/>
                        </div>    
                    </div>    
                    <div class="col-md-2"></div>
                </div>    
            </div>
        </div>
        <br>
        <!-- End of PageContent -->
    </main>

@endsection

@push('extra-css')

    <link rel="stylesheet" href="{{ asset('web_assets/vendor/notification_toaster/notification_toaster.css') }}">

@endpush
@push('extra-scripts')
    <script type="text/javascript" src="{{ asset('web_assets/vendor/notification_toaster/notification_toaster.js') }}"></script>

    <script type="text/javascript">

        $(function (){

            window.livewire.on('quickOrderError', (msg) => {
                console.log(msg)
                $.iaoAlert({
                    msg: msg.msg ? msg.msg : 'Invalid Data , Try again!',
                    type: "error",
                    mode: "dark",
                })
            });

            window.livewire.on('quickOrderSuccess', () => {
                $.iaoAlert({
                    msg: 'Success : All products has been added to your cart.',
                    type: "success",
                    mode: "dark",
                    autoHide: false
                });

                setTimeout(function (){

                    window.location  = '{{ route(config('constants.WEB_PREFIX').'cart') }}'

                },1000)
            });


        })

    </script>

@endpush
