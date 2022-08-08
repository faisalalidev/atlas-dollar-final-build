<div>
    <h4 class="content-title">Cron Jobs
        <div class="text-black-50 fs-6 mt-2">Current Time ({{ \Illuminate\Support\Carbon::now().' '.(\Carbon\Carbon::now())->timezone->getName() }})</div>
    </h4>
    <br>
    <table class="table" style="width:100%">
        <thead>
        <tr>
            <th width="50%">Name</th>
            <th>Cron Time</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($crons as $cron)
            <tr>
                <td>
                    <a class="itemside" href="#">
                        {{ $cron->name }}
                    </a>
                </td>
                <td class="font-small-gray">{{ $cron->time_to_execute }}</td>
                <td>
                    <div class="dropdown float-end">
                        <a href="#" data-bs-toggle="dropdown" class="btn btn-light btn-sm"> <i
                                class="material-icons md-more_horiz"></i> </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" data-bs-toggle="modal"
                               data-bs-target="#editcronjob{{ $cron->id }}-modal">Edit</a>
                        </div>
                    </div>
                </td>
                <div class="modal fade" id="editcronjob{{ $cron->id }}-modal" tabindex="-1"
                     aria-labelledby="editcronjob-modal-label" aria-hidden="true">
                    <form wire:submit.prevent="updateCron(Object.fromEntries(new FormData($event.target)))"
                          enctype="multipart/form-data">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $cron->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <input type="hidden" name="id" value="{{ $cron->id }}">
                            <div class="modal-body">
                                <div class="input-group">
                                    <label class="form-label">Time</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i
                                                class="icon material-icons md-access_time"></i></span>
                                        <input type="text" id='datetimepicker2{{ $cron->id }}' class="form-control" name="time_to_execute"
                                               onkeydown="return false" value="" aria-label="time">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" onclick="connectionApi($(this),'Save changes ')" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                @push('extra-scripts')

                    <script>

                        $('#datetimepicker2{{ $cron->id }}').datetimepicker({
                            format: 'LT',
                            useCurrent: false,
                            icons: {
                                time: "fa fa-clock-o",
                                date: "fa fa-calendar",
                                up: "fa fa-arrow-up",
                                down: "fa fa-arrow-down"
                            },
                        }).data("DateTimePicker").date('{{ $cron->time_to_execute }}');

                        $('#editcronjob{{ $cron->id }}-modal').on('shown.bs.modal', function() {
                            $('.bootstrap-datetimepicker-widget').css('z-index','1600');
                        });

                    </script>
                @endpush

            </tr>
        @endforeach

        </tbody>
    </table>
</div><!-- content-body .// -->
