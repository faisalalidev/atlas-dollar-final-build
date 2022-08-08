<table id="{{ \Illuminate\Support\Str::snake($module_name) }}" class="table" style="width:100%">
    <thead>
    </thead>
    <tbody>
    </tbody>
</table>

@push('extra-scripts')
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script>
        var table = $('#' + "{{ \Illuminate\Support\Str::snake($module_name) }}").DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            "targets": 'no-sort',
            "bSort": false,
            ajax: "{{ $ajax_data_url }}",
            columns: {!! json_encode($module_columns) !!},
        });
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endpush
