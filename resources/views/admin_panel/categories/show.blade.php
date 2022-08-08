@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main">

        <div class="content-header">
            <h2 class="content-title">{{ $page_title }}</h2>
            <div>
               
            </div>
        </div>

        <div class="card mb-4 p-2">
            <div class="container" style="margin-top:10px;">
                @include('admin_panel.includes.datatable' , [
                                'module_name' => $module_name,
                                'ajax_data_url' => route($module_ajax_listing_url),
                                'module_columns' => $primary_dt_columns
                            ])
            </div>
        </div>

    </section>

@endsection


