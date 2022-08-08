@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    @if(count($quick_order_errors))
        <div>
            <ul class="alert">
                @foreach($quick_order_errors as $quick_order_error)
                    @isset($quick_order_error['invalid_product_sku'])
                        @foreach($quick_order_error['invalid_product_sku'] as $invalid_product_sku)
                            <li style="color: red">This SKU is invalid : {{ $invalid_product_sku }}</li>
                        @endforeach
                    @endisset
                    @isset($quick_order_error['invalid_product_quantity'])
                        @foreach($quick_order_error['invalid_product_quantity'] as $invalid_product_quantity)
                            <li style="color: red">The quantity for SKU ({{ $invalid_product_quantity }}) is invalid.
                            </li>
                        @endforeach
                    @endisset
                @endforeach
            </ul>
        </div>
    @endif

    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="#">Shopping Cart</a></li>
                    <li><a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}">Checkout</a></li>
                    <li><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">

                <livewire:cart.listing.page/>

            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection

@push('extra-scripts')

    <script>

        function clearCart() {

            if (confirm('Do you want to remove the cart items?')) {
                window.location = '{{ route(config('constants.WEB_PREFIX').'clear_cart') }}';
            }
        }

        function saveCartPopup() {
            Swal.fire({
                title: 'Enter name for saved cart. This would be useful for future reference.',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'true'
                },
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: (data) => {
                    $.post('{{ route(config('constants.WEB_PREFIX') . 'save_cart') }}', {
                        'cart_name': data,
                        '_token': '{{ csrf_token() }}'
                    }).then(() => {
                        let timerInterval
                        Swal.fire({
                            title: 'Cart has been saved!',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            window.location = "{{ route(config('constants.WEB_PREFIX') . 'account') }}#saved-carts"
                        })
                    }).catch((e) => {
                       location.reload();
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

    </script>

@endpush
