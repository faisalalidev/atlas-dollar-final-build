@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')

    <main class="main">

        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="{{ route(config('constants.WEB_PREFIX').'home') }}">Home</a></li>
                    <li>Products</li>
                </ul>
            </div>
        </nav>

        <div class="container mt-2 pt-2">

            <div>
                <div class="row grid banner-product-wrapper mb-6">
                    @foreach($inventories as $index =>$inventory)
                        <div class="grid-item col-xl-5col col-lg-3 col-sm-4 col-6">
                            @include('web.inventories.single_inventory')
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </main>

@endsection
