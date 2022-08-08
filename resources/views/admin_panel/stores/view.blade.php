@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <div class="content-header">
            <h2 class="content-title">View {{ $page_title }}</h2>
        </div>

        <div class="row mb-4">
            <div class="col-xl-12 col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Name</label>
                                    <input type="text" id="" class="form-control" placeholder=""
                                           value="{{ $data->name ? $data->name : '-' }}" readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Email</label>
                                    <input type="text" id="" class="form-control" placeholder=""
                                           value="{{ $data->email }}" readonly>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Phone</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->phone ? $data->phone : '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Phone 2</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->phone2 ? $data->phone2 : '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Phone 3</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->phone3 ? $data->phone3 : '-' }}" readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Address</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->address ? $data->address : '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">City</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->city ? $data->city : '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">State</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->state ? $data->state : '-' }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label mb-10">Country</label>
                                    <input type="text" class="form-control" id="" placeholder=""
                                           value="{{ $data->country ? $data->country : '-' }}" readonly>
                                </div>
                            </div>
                            </div>

                    </div>
                </div> <!-- card end// -->
                @if(!empty($data->contacts->toArray()))
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">{{ $page_title }} Contacts</h5>
                        <div class="row">
                            @foreach($data->contacts as $contact)

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">First Name</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->first_name ? $contact->first_name : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Last Name</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->last_name ? $contact->last_name : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Phone</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->phone1 ? $contact->phone1 : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Email</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->email ? $contact->email : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Address</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->address1 ? $contact->address1 : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">City</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->city ? $contact->city : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">State</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->state ? $contact->state : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Country</label>
                                        <input type="text" class="form-control" id="" placeholder=""
                                               value="{{ $contact->country ? $contact->country : '-' }}"
                                               readonly>
                                    </div>
                                </div>

                                <hr>

                            @endforeach
                        </div>
                    </div>
                </div> <!-- card end// -->
                @endif
            </div> <!-- col end// -->
        </div> <!-- row end// -->


    </section>

@endsection
