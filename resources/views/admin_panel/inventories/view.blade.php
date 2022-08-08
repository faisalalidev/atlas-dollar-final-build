@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')


    <section class="content-main" style="max-width:1200px">

        <div class="content-header">
            <h2 class="content-title">View {{ $page_title }}</h2>
        </div>

        <div class="row mb-4">
            <div class="col-xl-8 col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="product_title" class="form-label">Product title</label>
                            <input disabled value="{{ $data->description }}" type="text" placeholder="-" class="form-control" id="product_title">
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-4  mb-3">
                                <label for="product_sku" class="form-label">SKU</label>
                                <input type="text" disabled value="{{ $data->part_number }}" placeholder="-" class="form-control" id="product_sku">
                            </div>
                            <div class="col-md-4  mb-3">
                                <label for="product_color" class="form-label">Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" disabled value="{{ $data->float_price }}" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="col-md-4  mb-3">
                                <label for="product_size" class="form-label">Quantity</label>
                                <input type="text" disabled value="{{ $data->in_stock }}" placeholder="0" class="form-control" id="product_size">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Description</label>
                            <textarea placeholder="-" disabled value="{{ $data->description2 }}" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div> <!-- card end// -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Custom Fields</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Min Limit</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->weight }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Max Limit</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->size1 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Unit Size</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->size3 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Supplier</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->supplier_part_number }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Status</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->status }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Item Number</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->item_number }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Vendor</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->vendor_id }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Whole Sale</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->whole_sale }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Extra</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->extra }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Freight</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->freight }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Duty</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->duty }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Landed</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->landed }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Unit Of Measure</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->unit_of_measure }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Measurement 1</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->measurement1 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Measurement 2</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->measurement2 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Size 1</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->size1 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Size 2</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->size2 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Size 3</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->size3 }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">E Commerce</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->e_commerce }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Kit Type</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->kit_type }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Weight</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->weight }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Inventory Selling Comment</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->inventory_selling_comment }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Inventory Invoice Comment</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->inventory_invoice_comment }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Inventory Web Comment</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->inventory_web_comment }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Back Order</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->back_order ? 'Yes' : 'No' }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label mt-2">Last Update</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" disabled value="{{ $data->wind_ward_updated_at }}" placeholder="" class="form-control" id="product_sku">
                            </div>
                        </div>
                        <hr>
                    </div>
                </div> <!-- card end// -->
            </div> <!-- col end// -->
            <aside class="col-xl-4 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="form-label">Status</label>
                        <select disabled class="form-control">
                            <option selected>{{ $data->status }}</option>
                        </select>
                    </div>
                </div> <!-- card end// -->
                <div class="card mb-4">
                    <div class="card-body">
                        <label class="form-label">Category</label>
                        <select disabled class="form-control">
                            <option selected>{{ $data->category->name }}</option>
                        </select>
                    </div>
                </div> <!-- card end// -->

                <div class="card mb-4">
                    <div class="card-body product-page">
                        <form id="file-upload-form" class="uploader">
                            <label for="file-upload" id="file-drag" class="d-flex align-items-center">
                                <img id="file-image" src="{{ asset($data->display_image) }}" onerror="this.src='{{ asset('admin_assets/img/default-product-image.png') }}'" alt="Preview" class="">
                                <div id="response" class="">
                                    <div id="messages"></div>
                                </div>
                            </label>
                        </form>
                    </div>
                </div> <!-- card end// -->
            </aside> <!-- col end// -->
        </div> <!-- row end// -->


    </section>


@endsection

