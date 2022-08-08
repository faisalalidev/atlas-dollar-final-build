@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main">
        <!-- Start of PageContent -->
        <div class="page-content pt-10">
            <div class="container">
                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-10" role="tablist">
                        <li class="nav-item">
                            <a href="#account-dashboard"
                               class="nav-link {{ $errors->isEmpty() && !session()->has('success') ? 'active' : '' }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link">Orders</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-invoices" class="nav-link">Invoices</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-details"
                               class="nav-link {{ !$errors->isEmpty() || session()->has('success') ? 'active' : '' }}">Account
                                Details</a>
                        </li>
                        <li class="nav-item">
                            <a href="#saved-carts" class="nav-link">Saved Carts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               onclick="window.location= '{{ route(config('constants.WEB_PREFIX') .'logout') }}'"
                               href="{{ route(config('constants.WEB_PREFIX') .'logout') }}">Logout</a>
                        </li>
                    </ul>

                    <div class="tab-content mb-10">
                        <div class="tab-pane {{ $errors->isEmpty() && !session()->has('success') ? 'active' : '' }} in"
                             id="account-dashboard">
                            <p class="greeting">
                                Hello
                                <span class="text-dark font-weight-bold">{{ getLoggedInUser()->name }}</span>
                                (not
                                <span class="text-dark font-weight-bold">{{ getLoggedInUser()->name }}</span>?
                                <a href="{{ route(config('constants.WEB_PREFIX') .'logout') }}" class="text-primary">Log
                                    out</a>)
                            </p>

                            <p class="mb-4">
                                From your account dashboard you can view your <a href="#account-orders"
                                                                                 class="text-primary link-to-tab">recent
                                    orders</a>,
                                manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
                                    and billing
                                    addresses</a>, and
                                <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                    account details.</a>
                            </p>

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-orders" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Orders</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-invoices" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-download"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Invoices</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-details" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-user"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Account Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#saved-carts" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-cart"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Saved Carts</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="{{ route(config('constants.WEB_PREFIX') .'logout') }}">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Logout</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane mb-4" id="account-orders">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">Order</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-items">Items</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="order-id">
                                            #{{ $order->id }}</td>
                                        <td class="order-date">{{ date('M d, Y',strtotime($order->created_at)) }}</td>
                                        <td class="order-items">{{ count($order->products) }}</td>
                                        <td class="order-total">
                                            <span
                                                class="order-price">{{ addCurrencyToPrice($order->getTotalAmount()) }}</span>
                                        <!--
                                            for
                                            <span class="order-quantity"> {{ count($order->products) }}</span> item
-->
                                        </td>
                                        <td class="order-action">
                                            <a href="{{ route(config('constants.WEB_PREFIX') .'order_view',['id' => $order->id,'view' => '1']) }}"
                                               class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route(config('constants.WEB_PREFIX') .'shop') }}"
                               class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane mb-4" id="account-invoices">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Invoices</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">Invoice Id</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-items">Items</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $order)
                                    <tr>
                                        <td class="order-id">
                                            #{{ $order->invoice_number }}</td>
                                        <td class="order-date">{{ date('M d, Y',strtotime($order->invoice_date)) }}</td>
                                        <td class="order-items">{{ count($order->products) }}</td>
                                        <td class="order-total">
                                            <span
                                                class="order-price">{{ $order->total_amount }}</span>
                                        <!--
                                            for
                                            <span class="order-quantity"> {{ count($order->products) }}</span> item
-->
                                        </td>
                                        <td class="order-action">
                                            <a href="{{ route('admin_invoices_pdf' , ['id' => $order->id]) }}"
                                               class="btn btn-outline btn-default btn-block btn-sm btn-rounded">Download</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route(config('constants.WEB_PREFIX') .'shop') }}"
                               class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                        <div class="tab-pane mb-4" id="saved-carts">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Saved Carts</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-total">Name</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-items">Items</th>
                                    <th class="order-actions">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($saved_carts as $saved_cart)
                                    <tr>
                                        <td class="order-id">
                                            {{ ucfirst($saved_cart->name) }}</td>
                                        <td class="order-date">{{ date('M d, Y',strtotime($saved_cart->updated_at)) }}</td>
                                        <td class="order-items">{{ count($saved_cart->items) }}</td>
                                        <td class="order-action">
                                            <a href="{{ route(config('constants.WEB_PREFIX') . 'view_saved_cart' , ['id' => $saved_cart->id]) }}"
                                               class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                            <a href="{{ route(config('constants.WEB_PREFIX') . 'remove_saved_cart' , ['id' => $saved_cart->id]) }}"
                                               onclick="return confirm('Are you sure?')" class="btn btn-outline btn-danger btn-block btn-sm btn-rounded">Remove</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <a href="{{ route(config('constants.WEB_PREFIX') .'shop') }}"
                               class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="tab-pane" id="account-downloads">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-downloads mr-2">
                                        <i class="w-icon-download"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title ls-normal">Downloads</h4>
                                </div>
                            </div>
                            <p class="mb-4">No downloads available yet.</p>
                            <a href="{{ route(config('constants.WEB_PREFIX').'shop') }}"
                               class="btn btn-dark btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>

                        <div class="tab-pane" id="account-addresses">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                                </div>
                            </div>
                            <p>The following addresses will be used on the checkout page
                                by default.</p>
                            <div class="row">
                                <div class="col-sm-6 mb-6">
                                    <div class="ecommerce-address billing-address pr-lg-8">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->first_name .' '. getUserStoreAddress()->last_name : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Company:</th>
                                                    <td>{{ getLoggedInUser()->store ? getLoggedInUser()->store->name : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->address1 .' '. getUserStoreAddress()->address2 : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->city : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->country : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Postcode:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->postal : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->phone1.(getUserStoreAddress()->phone1 ? ' - '. getUserStoreAddress()->phone1 : '') : '-' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-6">
                                    <div class="ecommerce-address shipping-address pr-lg-8">
                                        <h4 class="title title-underline ls-25 font-weight-bold">Shipping Address</h4>
                                        <address class="mb-4">
                                            <table class="address-table">
                                                <tbody>
                                                <tr>
                                                    <th>Name:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->first_name .' '. getUserStoreAddress()->last_name : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Company:</th>
                                                    <td>{{ getLoggedInUser()->store ? getLoggedInUser()->store->name : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->address1 .' '. getUserStoreAddress()->address2 : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>City:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->city : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->country : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Postcode:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->postal : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone:</th>
                                                    <td>{{ getUserStoreAddress() ? getUserStoreAddress()->phone1.(getUserStoreAddress()->phone1 ? ' - '. getUserStoreAddress()->phone1 : '') : '-' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane {{ !$errors->isEmpty() || session()->has('success') ? 'active' : '' }}"
                             id="account-details">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                </div>
                            </div>
                            @include('web.includes.flash_messages')

                            <form class="form account-details-form"
                                  action="{{ route(config('constants.WEB_PREFIX') .'update_profile') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="display-name">Name *</label>
                                    <input type="text" name="name" value="{{ getLoggedInUser()->name }}" required
                                           class="form-control form-control-md mb-0">
                                    @if ($errors->has('name'))
                                        <span style="color: red"
                                              class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-6">
                                    <label for="email_1">Email address *</label>
                                    <input type="email" name="email" value="{{ getLoggedInUser()->email }}" required
                                           class="form-control form-control-md">
                                    @if ($errors->has('email'))
                                        <span style="color: red"
                                              class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                <div class="form-group">
                                    <label class="text-dark" for="new-password">New Password leave blank to leave
                                        unchanged</label>
                                    <input type="password" class="form-control form-control-md" name="password">
                                    @if ($errors->has('password'))
                                        <span style="color: red"
                                              class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-10">
                                    <label class="text-dark" for="conf-password">Confirm Password</label>
                                    <input type="password" class="form-control form-control-md"
                                           name="password_confirmation">
                                </div>
                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection


