@extends('admin_panel.main')

@section('page_title' , $page_title)

@push('extra-css')
    <link
        href="{{ asset('admin_assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}"
        rel="stylesheet" type="text/css"/>

    <!-- Bootstrap Daterangepicker CSS -->
    <link href="{{ asset('admin_assets//vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"
          rel="stylesheet" type="text/css"/>

    <livewire:styles />
    <link href="{{ asset('admin_assets/dist/css/bootstrap-tagsinput.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush

@push('extra-scripts')
    <script src="{{ asset('admin_assets/vendors/bower_components/moment/min/moment-with-locales.min.js') }}"></script>
    <script
        src="{{ asset('admin_assets/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script
        src="{{ asset('admin_assets/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

@endpush

@section('main_content')

    <section class="content-main">


            <div class="content-header">
                <h2 class="content-title">Settings</h2>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row gx-5">
                        <aside class="col-lg-3 border-end">

                            <nav class="nav nav-pills flex-lg-column mb-4" id="v-pills-tab" role="tablist">
                                <a class="nav-link active" id="v-pills-api-tab" data-bs-toggle="pill" data-bs-target="#v-pills-api" role="tab" aria-selected="true">API</a>
                                <a class="nav-link" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" role="tab" aria-selected="false">General</a>
                                <a class="nav-link" id="v-pills-email-tab" data-bs-toggle="pill" data-bs-target="#v-pills-email" role="tab" aria-selected="false">Emails</a>
                                <a class="nav-link" id="v-pills-cronjobs-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cronjobs" role="tab" aria-selected="false">Cron Jobs</a>
                            </nav>

                        </aside>
                        <div class="col-lg-9">
                            <div class="tab-content">
                                <livewire:admin.settings.check-connection/>
                                <section class="content-body p-xl-4 tab-pane fade" id="v-pills-general" role="tabpanel"
                                         aria-labelledby="v-pills-general-tab">
                                <livewire:admin.settings.application-settings/>
                                </section>

                                <section class="content-body p-xl-4 tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                                <livewire:admin.settings.emails/>
                                </section>

                                <section class="content-body p-xl-4 tab-pane fade" id="v-pills-cronjobs" role="tabpanel" aria-labelledby="v-pills-cronjobs-tab">
                                <livewire:admin.settings.cron-jobs/>
                                </section>

                            </div>
                        </div> <!-- col.// -->
                    </div> <!-- row.// -->

                </div> <!-- card-body .//end -->
            </div> <!-- card .//end -->
    </section>

@endsection

@push('extra-scripts')

    <script>

        function fileDragHover(e,id) {
            var fileDrag = document.getElementById(id+'-file-drag');

            fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload d-flex align-items-center');
        }

        function parseFile(file,id) {

            var imageName = file.name;

            var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
            if (isGood) {
                document.getElementById('start').classList.add("hidden");
                document.getElementById('response').classList.remove("hidden");
                document.getElementById('notimage').classList.add("hidden");
                // Thumbnail Preview
                document.getElementById(id+'-file-image').classList.remove("hidden");
                document.getElementById(id+'-file-image').src = URL.createObjectURL(file);
            }
            else {
                document.getElementById(id+'-file-image').classList.add("hidden");
                document.getElementById('notimage').classList.remove("hidden");
                document.getElementById('start').classList.remove("hidden");
                document.getElementById('response').classList.add("hidden");
                document.getElementById(id+"file-upload-form").reset();
            }
        }
    </script>

    <livewire:scripts/>

    <script src="{{ asset('admin_assets/dist/js/bootstrap-tagsinput.min.js') }}"></script>

    <script>

        window.addEventListener('closeModal', () => {

            $('.modal').modal('hide');
        });

        $(function (){
            $('.bootstrap-tagsinput input').keydown(function( event ) {
                if ( event.which == 13 ) {
                    $(this).blur();
                    $(this).focus();
                    return false;
                }
            })
        })
        function connectionApi(elm,msg = 'Connecting') {

            if (elm.hasClass('btn-success')) {
                return;
            }

            elm.text(msg);

            elm.removeClass('btn-primary');
            elm.addClass('btn-success');

            elm.append('<div class="spinner-border text-light spinner-border-sm" role="status"> <span class="visually-hidden">Loading...</span></div>')
        }
    </script>
@endpush

