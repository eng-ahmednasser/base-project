@component('mail::message')
# Hello {{$ticket->assignedTo->name}},

<br>
new ticket ({{$ticket->name}}) added to you .

Thanks,<br>
{{ config('app.name') }}
@endcomponent
