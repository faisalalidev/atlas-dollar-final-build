@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')


    <section class="content-main">

        <div class="col-lg-6 col-md-6 ms-auto text-md-end">
            <a class="btn btn-secondary ms-2" href="javascript:;" onclick="printDiv('invoice-detail')"><i
                    class="icon material-icons md-print"></i></a>
        </div>
        <iframe id="printf" name="printf" style="height: 1000px;width: 100%;" src="{{ route('admin_invoice_iframe',['id' => $data->id]) }}" title=""></iframe>

    </section>



@endsection

@push('extra-scripts')

    <script>
        function printDiv() {
            window.frames["printf"].focus();
            window.frames["printf"].print();
        }
    </script>

@endpush
