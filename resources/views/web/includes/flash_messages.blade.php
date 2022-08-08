@if(session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
    <div class="alert-danger">{{ session()->get('error') }}</div>
@endif
