@if ($errors->has($input_name))
    <span class="text-danger">{{ $errors->first($input_name) }}</span>
@endif

