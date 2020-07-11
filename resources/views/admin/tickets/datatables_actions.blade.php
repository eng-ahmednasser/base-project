
@if(auth()->user()->id == $ticket->created_by)
@can('edit tickets')
<a rel="tooltip" class="btn btn-success btn-link" href="{{route('admin.ticket.edit',$ticket->id)}}">
    <i class="material-icons">edit</i>
    <div class="ripple-container"></div>
</a>
@endcan
@can('delete tickets')
{{ Form::open(['method' => 'DELETE','class'=>'d-inline-block', 'route' => ['admin.ticket.destroy',$ticket->id], 'name' => 'delete']) }}
<a rel="tooltip" class="btn btn-success btn-link " href="#" onclick="deleteItem(this)">
    <i class="material-icons">delete</i>
    <div class="ripple-container"></div>
</a>
{{ Form::close() }}
@endcan

@endif

@if(auth()->user()->id == $ticket->assigned_to)
<a rel="tooltip" class="btn btn-success btn-link" href="{{route('admin.ticket-owner.edit',$ticket->id)}}">
    <i class="material-icons">edit</i>
    <div class="ripple-container"></div>
</a>
@endif
