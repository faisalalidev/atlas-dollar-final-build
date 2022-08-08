@switch($status)

    @case('Work Order')
    <span class="badge rounded-pill alert-warning">{{ $status }}</span>
    @break

    @case('Estimate')
    <span class="badge rounded-pill alert-secondary">{{ $status }}</span>
    @break

    @case('Final Invoice')
    <span class="badge rounded-pill alert-success">{{ $status }}</span>
    @break

@endswitch
