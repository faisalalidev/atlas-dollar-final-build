<script src="{{ asset('admin_assets/admin/js/jquery-3.5.0.min.js') }}"></script>
<script src="{{ asset('admin_assets/admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_assets/admin/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_assets/admin/js/script-v=1.0.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    if(localStorage.getItem("darkmode")){
        var body_el = document.body;
        body_el.className += 'dark';
    }
</script>


<script type="text/javascript">

    function checkConnection() {

        $('#connection-btn').removeClass('btn-primary')
        $('#connection-btn').removeClass('btn-success')
        $('#connection-btn').removeClass('btn-danger')
        $('#connection-btn').addClass('btn-info')
        $('#connection-btn').text('Checking...')
        $('#api-error').html('')
        $('#api-connected').html('')

        $.get('{{ route('admin_check_connection') }}').done(function (data) {

            $('#connection-btn').text('Connected')

            $('#connection-btn').addClass('btn-success')
            $('#connection-btn').removeClass('btn-info')

            $('#api-connected').html(JSON.stringify(data).replace(new RegExp(',', 'g'), ',<br>'))

        }).fail(function (error) {
            $('#connection-btn').text('Check Again')
            $('#connection-btn').addClass('btn-danger')
            $('#connection-btn').removeClass('btn-info')
            $('#api-error').html(JSON.stringify(error).replace(new RegExp(',', 'g'), ',<br>'))
        })
    }

    function changeStatus(elm,url,table_id){

        $.get(url,{active : elm.is(":checked") ? 1 : 0}).done(function (data){

            if (table_id){

                let table =  $('#'+table_id).DataTable();
                table.ajax.reload();

            }
        })
    }



</script>

@stack('extra-scripts')
