<!DOCTYPE html>
<html lang="en">
@include('admin_panel.includes.head')
<body>

@include('admin_panel.includes.sidebar')

<main class="main-wrap">

@include('admin_panel.includes.header')

    @yield('main_content')

    <div id="connectionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h5 class="modal-title" id="myModalLabel">Check Api Connection</h5>
                </div>
                <div class="modal-body">
                    <h5 class="mb-15">Click on the button to check the api connection</h5>
                    <br>
                    <p class="text-success" id="api-connected"></p>
                    <p class="text-danger" id="api-error"></p>
                </div>
                <div class="modal-footer">
                    <button id="connection-btn" type="button" onclick="checkConnection()" class="btn btn-primary">Check Connection</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


</main>


@include('admin_panel.includes.scripts')

</body>

</html>
