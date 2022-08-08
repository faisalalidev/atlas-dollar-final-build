@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main">

        <div class="content-header">
            <h2 class="content-title">{{ $page_title }} Detail</h2>
        </div>


        <div class="card" id="invoice-detail">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                <span>
                  <i class="material-icons md-calendar_today"></i> <b>{{ date('M d, Y, h:i:a') }}</b>
                </span> <br>
                        <small class="text-muted">Order ID: {{ $data->id }}</small>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <a class="btn btn-secondary ms-2" href="javascript:;" onclick="printDiv('invoice-detail')"><i
                                class="icon material-icons md-print"></i></a>
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">

                <div class="row mb-5 order-info-wrap">
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                  <span class="icon icon-sm rounded-circle bg-primary-light">
                    <i class="text-primary material-icons md-person"></i>
                  </span>
                            <div class="text">
                                <h6 class="mb-1">Customer</h6>
                                <p class="mb-1">
                                    {{ $address ? $address->first_name.' '.$address->last_name : '-' }}<br>
                                    @if($address && $address->address)
                                        {{ $data->billedTo[0]->address1 }} <br>
                                    @endif
                                    @if($address && $address->city && $address->postal)
                                        {{ $address->city }}, {{ $address->postal }}
                                        <br>
                                    @endif
                                    @if($address && $address->state && $address->country)
                                        {{ $address->state }}, {{ $address->country }}
                                    @endif
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                  <span class="icon icon-sm rounded-circle bg-primary-light">
                    <i class="text-primary material-icons md-local_shipping"></i>
                  </span>
                            <div class="text">
                                <h6 class="mb-1">Order info</h6>
                                <p class="mb-1">
                                    Shipping: {{ $address ? $address->first_name.' '.$address->last_name : '-' }} <br>
                                    Pay method: Cash <br>
                                    Status: @include('admin_panel.includes.order_statuses',['status' => $data->status])<br>
                                    Type: {{ $data->order_type }}
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                  <span class="icon icon-sm rounded-circle bg-primary-light">
                    <i class="text-primary material-icons md-place"></i>
                  </span>
                            <div class="text">
                                <h6 class="mb-1">Deliver to</h6>
                                <p class="mb-1">
                                    {{ $address ? $address->first_name.' '.$address->last_name : '-' }}<br>
                                    @if($address && $address->address)
                                        {{ $data->billedTo[0]->address1 }} <br>
                                    @endif
                                    @if($address && $address->city && $address->postal)
                                        {{ $address->city }}, {{ $address->postal }}
                                        <br>
                                    @endif
                                    @if($address && $address->state && $address->country)
                                        {{ $address->state }}, {{ $address->country }}
                                    @endif
                                </p>
                            </div>
                        </article>
                    </div> <!-- col// -->
                </div> <!-- row // -->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table border table-hover table-lg">
                                <thead>
                                <tr>
                                    <th width="40%">Product</th>
                                    <th width="20%">Unit Price</th>
                                    <th width="20%">Quantity</th>
                                    <th width="20%" class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data->products as $product)
                                    <tr>
                                        <td>
                                            <a class="itemside"
                                               href="{{ route('admin_inventories_view',['id' => $product->inventory->id]) }}">
                                                <div class="left">
                                                    <img src="{{ asset($product->inventory->display_image) }}"
                                                         onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'"
                                                         width="40" height="40" class="img-xs" alt="Item">
                                                </div>
                                                <div class="info"> {{ $product->description }}   </div>
                                                <div class="info"> {{ $product->inventory->description }}</div>
                                            </a>
                                        </td>
                                        <td> {{ addCurrencyToPrice($product->price) }} </td>
                                        <td> {{ $product->quantity }} </td>
                                        <td class="text-end"> {{ addCurrencyToPrice((double)$product->price * (int)$product->quantity) }}  </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">
                                        <article class="float-end">
                                            <dl class="dlist">
                                                <dt>Sub Total:</dt>
                                                <dd>${{ $data->getTotalAmount() }}</dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt>Grand total:</dt>
                                                <dd><b class="h5">${{ $data->getTotalAmount() }}</b></dd>
                                            </dl>
                                            <dl class="dlist">
                                                <dt class="text-muted">Status:</dt>
                                                <dd>
                                                    @include('admin_panel.includes.order_statuses',['status' => $data->status])
                                                </dd>
                                            </dl>
                                        </article>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="h-25 pt-4">
                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea disabled class="form-control" name="notes" id="notes" placeholder="-">{{ $data->customer_notes ? $data->customer_notes : '-' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>


@endsection
@push('extra-scripts')

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

@endpush
