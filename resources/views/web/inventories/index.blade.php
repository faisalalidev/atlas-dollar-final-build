@extends('web.main')

@section('page_title' , $page_title)

@section('web_main_content')
    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="{{ route(config('constants.WEB_PREFIX').'home') }}">Home</a></li>
                    <li>Shop</li>
                </ul>
            </div>
        </nav>
        <div class="page-content mb-10">
            <!-- End of Shop Banner -->
            <div class="container">
                <!-- Start of Shop Content -->
                <livewire:inventory.shop-listing/>
                <!-- End of Shop Content -->
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection
