<section class="content-body p-xl-4 tab-pane fade show active" id="v-pills-api" role="tabpanel"
         aria-labelledby="v-pills-api-tab">
    <h4 class="content-title">API</h4>
    <br>
    @if($success)
        <div class="alert alert-success d-flex align-items-center p-2" role="alert">
            <i class="icon material-icons md-check_circle mr-2"></i>
            <div>
                Congratulations ! You've successfully authenticated with Windward API!
            </div>
        </div>
    @endif
    @if($error)
        <div class="alert alert-danger d-flex align-items-center p-2" role="alert">
            <i class="icon material-icons md-cancel mr-2"></i>
            <div>
                Sorry ! You've failed authenticated with Windward API!
            </div>
        </div>
    @endif
    <div class="row mb-4 pb-4">
        <form wire:submit.prevent="checkApiConnection(Object.fromEntries(new FormData($event.target)))" class="p-0">
            <div class="col-lg-12  mb-3">
                <label class="form-label">API Url</label>
                <input class="form-control" type="text" name="url" value="{{ env('WINDWARD_URL') }}"
                       placeholder="http://your-server.com/Windward/WebAPI/">
            </div>
            <div class="col-lg-12  mb-3">
                <label class="form-label">API Username</label>
                <input class="form-control" type="text" name="user_name" value="{{ env('WINDWARD_USER_NAME') }}"
                       placeholder="">
            </div>
            <div class="col-lg-12  mb-3">
                <label class="form-label">API Password</label>
                <input class="form-control" type="password" name="password" value="{{ env('WINDWARD_PASSWORD') }}"
                       placeholder="">
            </div>
            <div class="col-lg-12  mb-3">
                <br>
                <button class="btn btn-primary" onclick="connectionApi($(this))" type="submit">Connect</button>
            </div>
        </form>
    </div>
</section>

