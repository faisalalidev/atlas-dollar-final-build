@if($row->back_order)
    <span class="badge rounded-pill alert-warning">Backorder ({{ $row->in_stock }})</span>
@elseif($row->in_stock)
    <span class="badge rounded-pill alert-success">InStock ({{ $row->in_stock }})</span>
@else
    <span class="badge rounded-pill alert-danger">OutOfStock ({{ $row->in_stock }})</span>
@endif
