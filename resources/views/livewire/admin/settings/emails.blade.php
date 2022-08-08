<form wire:submit.prevent="updateEmails(Object.fromEntries(new FormData($event.target)))"
      enctype="multipart/form-data">
    <h4 class="content-title">Emails</h4>
    <br>
    <div class="row border-bottom mb-4 pb-4">
        <div class="col-md-5">
            <h5>Reporter Email</h5>
            <p class="text-muted" style="max-width:90%">
                Email address for server and API side reporting of errors will be emailed.</p>
        </div> <!-- col.// -->
        <div class="col-md-7">
            <div class="mb-3">
                <input class="form-control" data-role="tagsinput" type="text" name="reporter_email"
                       placeholder="example@example.com, example@example.com"
                       value="{{ $reporter_email ? $reporter_email->setting_value : '' }}"/>
            </div>
        </div> <!-- col.// -->
    </div> <!-- row.// -->
    @foreach($emails as $email)
        <div class="row border-bottom mb-4 pb-4">
            <div class="col-md-5">
                <h5>{{ $email->title }}</h5>
                <p class="text-muted" style="max-width:90%">{{ $email->description }}</p>
            </div> <!-- col.// -->
            <div class="col-md-7">
                <div class="mb-3">
                    <input class="form-control" data-role="tagsinput" type="text" name="{{ $email->slug }}"
                           placeholder="example@example.com, example@example.com" value="{{ $email->recipients }}"/>
                </div>
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    @endforeach
    <div class="row">
        <div class="col-md-12 p-0">
            <button class="btn btn-primary" onclick="connectionApi($(this),'Save')" type="submit">Save</button>
        </div>    
    </div>  
</form><!-- content-body .// -->
