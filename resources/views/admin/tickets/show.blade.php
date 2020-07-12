@extends('admin.layouts.app', ['activePage' => 'ticket-management', 'titlePage' => __('Ticket management')])

@section('content')

<div class="row">
    <div class="col-md-12">
        <p>
            <b>name - </b>{{$ticket->name}}
        </p>
        <br>
        <p>
            <b>description - </b>{{$ticket->description}}
        </p>

        <br>
        <p>
            <b>dateline - </b>{{$ticket->dateline}}
        </p>
        <br>
        <p>
            <b>Creator - </b>{{$ticket->createdBy->name}}
        </p>
        <br>
        <p>
            <b>Assigned to - </b>{{$ticket->assignedTo->name}}
        </p>
        <br>
        <p>
            {{-- <b>status - </b>{{Ticket::STATUS[$ticket->status]}} --}}
        </p>

    </div>
</div>

@endsection
