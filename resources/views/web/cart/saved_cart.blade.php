@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="#">{{ $cart->name }}</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-12">
                    <div class="col-lg-12 pr-lg-12 mb-6">
                            <div id="cart-products" style="">
                                <table class="shop-table cart-table">
                                    <thead>
                                    <tr>
                                        <th class="product-name"><span>Product</span></th>
                                        <th></th>
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $index => $item)
                                        @php
                                            $inventory = $item->inventory;
                                        @endphp
                                        <tr>
                                            <td class="product-thumbnail">
                                                <div class="p-relative">
                                                    <a href="#" class="btn-quickview"
                                                       data-selector="{{ 'list-'.$inventory->inventory_id }}">
                                                        <figure>
                                                            <img style="height: 100px;" src="{{ asset($inventory->display_image) }}"
                                                                 onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                                                 alt="product"
                                                                 width="300" height="338">
                                                        </figure>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="product-name">
                                                <a href="#" class="btn-quickview"
                                                   data-selector="{{ 'list-'.$inventory->inventory_id }}">
                                                    {{ $item->inventory->description }}
                                                </a>
                                            </td>
                                            <td class="product-price"><span class="amount">{{ $item->inventory->price }}</span></td>
                                            <td class="product-quantity">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="product-subtotal">
                        <span
                            class="amount">{{ addCurrencyToPrice($item->inventory->float_price * $item->quantity) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="cart-action mb-6">
                                    <a href="{{ url()->previous() }}#saved-carts"
                                            class="btn btn-rounded btn-default">Go Back
                                    </a>
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                &nbsp;
                                    <a href="{{ route(config('constants.WEB_PREFIX') . 'load_saved_cart' , ['id' => $cart->id]) }}"
                                            class="btn btn-rounded btn-success">Load Cart
                                    </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection
