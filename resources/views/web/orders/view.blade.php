@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main order">
        <!-- Start of Breadcrumb -->
        @if(!request()->has('view'))
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="#">Shopping Cart</a></li>
                        <li class="passed"><a href="#">Checkout</a></li>
                        <li class="active"><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
    @endif
    <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content mb-10 pb-2">
            <div class="container">
                @if(!request()->has('view'))
                    <div class="order-success text-center font-weight-bolder text-dark">
                        <i class="fas fa-check"></i>
                        Thank you. Your order has been received.
                    </div>
                @endif
            <!-- End of Order Success -->

                <ul class="order-view list-style-none">
                    <li>
                        <label>Order number</label>
                        <strong>{{ $data->id }}</strong>
                    </li>
                    <li>
                        <label>Status</label>
                        <strong>{{ $data->status }}</strong>
                    </li>
                    <li>
                        <label>Date</label>
                        <strong>{{ date('M d, Y',strtotime($data->created_at)) }}</strong>
                    </li>
                    <li>
                        <label>Total</label>
                        <strong>{{ addCurrencyToPrice($data->getTotalAmount()) }}</strong>
                    </li>
                    <li>
                        <label>Payment method</label>
                        <strong>Cash On Delivery</strong>
                    </li>
                </ul>
                <!-- End of Order View -->

                <div class="order-details-wrapper mb-5">
                    <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                    <table class="order-table">
                        <thead>
                        <tr>
                            <th class="text-dark">Product</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!count($data->products) && session()->has('order_items'))

                            @foreach(session()->get('order_items') as $index => $product)
                                @php
                                    $inventory = $product->inventory;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="#" class="btn-quickview"
                                           data-selector="{{ 'order-'.$inventory->inventory_id }}">
                                            {{ $inventory->description }}
                                        </a>&nbsp;
                                        <strong>x {{ $product->quantity }}</strong><br>
                                    </td>
                                    <td>{{ addCurrencyToPrice((isset($product->inventory->prices[0]) ? $product->inventory->prices[0]->regular : $product->inventory->price) * $product->quantity) }}</td>
                                </tr>
                                @include('web.inventories.view',['list_type' => 'order-'])
                            @endforeach

                        @else

                            @foreach($data->products as $index => $product)
                                @php
                                    $inventory = $product->inventory;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="#" class="btn-quickview"
                                           data-selector="{{ 'order-'.$inventory->inventory_id }}">
                                            {{ $inventory->description }}
                                        </a>&nbsp;
                                        <strong>x {{ $product->quantity }}</strong><br>
                                    </td>
                                    <td>{{ addCurrencyToPrice($product->price * $product->quantity) }}</td>
                                </tr>
                                @include('web.inventories.view',['list_type' => 'order-'])
                            @endforeach

                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Subtotal:</th>
                            <td>{{ addCurrencyToPrice($data->getTotalAmount()) }}</td>
                        </tr>

                        <tr>
                            <th>Payment method:</th>
                            <td>Cash On Delivery</td>
                        </tr>
                        <tr class="total">
                            <th class="border-no">Total:</th>
                            <td class="border-no">{{ addCurrencyToPrice($data->getTotalAmount()) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @if(!request()->has('view'))
                    <a href="{{ route(config('constants.WEB_PREFIX') .'shop') }}"
                       class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i
                            class="w-icon-long-arrow-left"></i>Back To Shop</a>
                @else
                    <a href="javascript:;" onclick="history.go(-1)"
                       class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i
                            class="w-icon-long-arrow-left"></i>Back To List</a>
                @endif
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection
