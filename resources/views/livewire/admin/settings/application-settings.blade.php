<form wire:submit.prevent="updateSettings(Object.fromEntries(new FormData($event.target)))"
      enctype="multipart/form-data" class="p-0">
    <h4 class="content-title">General</h4>
    <br>
    @foreach($data as $item)

        @switch($item->input_type)

            @case('image')

            <div class="row border-bottom mb-4 pb-4">
                <div class="col-md-5">
                    <h5>{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}</h5>
                </div>
                <div class="col-md-7">
                    <div class="logo-upload">
                        <div id="{{ $item->setting_name }}-file-upload-form" class="uploader">
                            <input id="{{ $item->setting_name }}-file" wire:model="{{ $item->setting_name }}"
                                   type="file" name="{{ $item->setting_name }}"
                                   accept="image/*"/>
                            <label for="{{ $item->setting_name }}-file" id="{{ $item->setting_name }}-file-drag"
                                   class="d-flex align-items-center">
                                @if($item->setting_name == 'logo')
                                <img id="{{ $item->setting_name }}-file-image"
                                     src="{{ $logo ? $logo->temporaryUrl() : asset($item->setting_value) }}" alt="Preview" class="">
                                @else
                                    <img id="{{ $item->setting_name }}-file-image"
                                         src="{{ $fav_icon ? $fav_icon->temporaryUrl() : asset($item->setting_value) }}" alt="Preview" class="">
                                @endif
                                <div id="start" class="hidden">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <div id="notimage" class="hidden">Please select an image</div>
                                    <span id="file-upload-btn" class="btn btn-primary">+</span>
                                </div>
                                <div id="response" class="">
                                    <div id="messages"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div> <!-- col.// -->
            </div>

            @push('extra-scripts')

                <script>

                    $(function () {
                        window['{{ $item->setting_name }}File'] = document.getElementById('{{ $item->setting_name }}-file');

                        if (window['{{ $item->setting_name }}File']) {

                            window['{{ $item->setting_name }}File'].addEventListener('change', function (e) {
                                // Fetch FileList object

                                let id = '{{ $item->setting_name }}';

                                var files = e.target.files || e.dataTransfer.files;

                                // Cancel event and hover styling
                                fileDragHover(e, id);

                                // Process all File objects
                                for (var i = 0, f; f = files[i]; i++) {
                                    parseFile(f, id);
                                }
                            }, false);

                        }
                    })
                </script>

            @endpush

            @break
            @case('text')

            <div class="row border-bottom mb-4 pb-4">
                <div class="col-md-5">
                    <h5>{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}</h5>
                </div>
                <div class="col-md-7">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="{{ $item->setting_name }}"
                               placeholder="{{ ucwords(str_replace('_', ' ', Illuminate\Support\Str::singular($item->setting_name))) }}"
                               required value="{{ $item->setting_value }}">
                    </div>

                </div>
            </div>
            @break

        @endswitch
    @endforeach
    <div class="row">
        <div class="col-md-12 p-0">
            <button class="btn btn-primary" onclick="connectionApi($(this),'Save')" type="submit">Save</button>
        </div>    
    </div>    
</form>
