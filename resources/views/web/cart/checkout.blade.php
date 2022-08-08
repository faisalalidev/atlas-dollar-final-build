@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main checkout">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="{{ route(config('constants.WEB_PREFIX').'cart') }}">Shopping Cart</a>
                    </li>
                    <li class="active"><a href="{{ route(config('constants.WEB_PREFIX').'checkout') }}">Checkout</a>
                    </li>
                    <li><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->


        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">

                <form class="form checkout-form" action="{{ route(config('constants.WEB_PREFIX') .'order') }}"
                      method="post">
                    @csrf
                    <div class="row mb-9">
                        <div class="col-lg-7 pr-lg-4 mb-4">
                            <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                Billing Details
                            </h3>
                            <div class="row gutter-sm">
                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" class="form-control form-control-md"
                                           value="{{ getLoggedInUser()->name }}" disabled>
                                </div>

                            </div>
                            @if($store_address && $store_address->store->name)
                                <div class="form-group">
                                    <label>Company name </label>
                                    <input type="text" class="form-control form-control-md"
                                           value="{{ $store_address->store->name }}" disabled>
                                </div>
                            @endif
                            @if($store_address && $store_address->country)
                                <div class="form-group">
                                    <label>Country / Region *</label>
                                    <input type="text" class="form-control form-control-md"
                                           value="{{ $store_address->country }}" disabled>
                                </div>
                            @endif
                            @if($store_address && ($store_address->address1 || $store_address->address2))
                                <div class="form-group">
                                    <label>Street address *</label>
                                    @if($store_address && $store_address->address1)
                                        <input type="text" placeholder="House number and street name"
                                               class="form-control form-control-md mb-2"
                                               value="{{ $store_address->address1 }}" disabled>
                                    @endif
                                    @if($store_address && $store_address->address2)
                                        <input type="text" placeholder="Apartment, suite, unit, etc. (optional)"
                                               class="form-control form-control-md"
                                               value="{{ $store_address->address2 }}" disabled>
                                    @endif
                                </div>
                            @endif
                            <div class="row gutter-sm">
                                @if($store_address && ($store_address->city || $store_address->postal))
                                    <div class="col-md-6">
                                        @if($store_address->city)
                                            <div class="form-group">
                                                <label>Town / City *</label>
                                                <input type="text"
                                                       class="form-control form-control-md"
                                                       value="{{ $store_address->city }}" disabled>
                                            </div>
                                        @endif
                                        @if($store_address->postal)
                                            <div class="form-group">
                                                <label>ZIP *</label>
                                                <input type="text"
                                                       class="form-control form-control-md"
                                                       value="{{ $store_address->postal }}" disabled>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if($store_address && ($store_address->state || $store_address->phone1))
                                    <div class="col-md-6">
                                        @if($store_address->state)
                                            <div class="form-group">
                                                <label>State *</label>
                                                <input type="text"
                                                       class="form-control form-control-md"
                                                       value="{{ $store_address->state }}" disabled>
                                            </div>
                                        @endif
                                        @if($store_address->phone1)
                                            <div class="form-group">
                                                <label>Phone *</label>
                                                <input type="text"
                                                       class="form-control form-control-md"
                                                       value="{{ $store_address->phone1 }}" disabled>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @if($store_address && $store_address->email)
                                <div class="form-group mb-7">
                                    <label>Email address *</label>
                                    <input type="email"
                                           class="form-control form-control-md"
                                           value="{{ $store_address->email }}" disabled>
                                </div>
                            @endif

                            <div class="form-group mt-3">
                                <label for="order-notes">Order Type</label>
                                <select class="form-control mb-0 select" id="order_type" name="order_type">
                                    <option value="Regular order">Regular Order</option>
                                    <option value="Drop Ship">Drop Ship</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="order-notes">Order notes (optional)</label>
                                <textarea class="form-control mb-0" id="order-notes" name="customer_notes" cols="30"
                                          rows="4"
                                          placeholder="Notes about your order, e.g special notes for delivery"></textarea>
                            </div>
                        </div>
                        @if($previous_order)
                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Previous Order</h3>
                                    <div class="order-summary">
                                        <table class="order-table">
                                            <thead>
                                            <tr>
                                                <th width="70">
                                                    <b>Product</b>
                                                </th>
                                                <th width="30">

                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($previous_order->products as $product)
                                                <tr class="bb-no">
                                                    <td class="product-name">{{ $product->inventory->description }} <i
                                                            class="fas fa-times"></i> <span
                                                            class="product-quantity">{{ $product->quantity }}</span>
                                                    </td>
                                                    <td class="product-total">{{ addCurrencyToPrice((isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $product->inventory->float_price) * $product->quantity) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                            <div class="order-summary-wrapper sticky-sidebar">
                                <h3 class="title text-uppercase ls-10">Your Order</h3>
                                <div class="order-summary">
                                    <table class="order-table">
                                        <thead>
                                        <tr>
                                            <th width="70">
                                                <b>Product</b>
                                            </th>
                                            <th width="30">

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart_items as $item)
                                            <tr class="bb-no">
                                                <td class="product-name">{{ $item->inventory->description }} <i
                                                        class="fas fa-times"></i> <span
                                                        class="product-quantity">{{ $item->quantity }}</span></td>
                                                <td class="product-total">{{ addCurrencyToPrice((isset($item->inventory->prices[0]) ? (double)$item->inventory->prices[0]->regular : $item->inventory->float_price) * $item->quantity) }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="cart-subtotal bb-no">
                                            <td>
                                                <b>Subtotal</b>
                                            </td>
                                            <td>
                                                <b>{{ addCurrencyToPrice($total_amount) }}</b>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr class="order-total">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td>
                                                <b>{{ addCurrencyToPrice($total_amount) }}</b>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    @if(count($cart_items))

                                        <div class="payment-methods" id="payment_method">
                                            <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
                                            <div class="accordion payment-accordion">

                                                <div class="card">

                                                    <div id="delivery" class="card-body">
                                                        <p class="mb-0">
                                                            Cash on delivery
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group place-order pt-6">
                                            <button type="submit" class="btn btn-primary btn-block">Place Order
                                            </button>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection

