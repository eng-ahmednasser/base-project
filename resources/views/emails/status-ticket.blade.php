@component('mail::message')
# Hello {{$ticket->createdBy->name}},
<br>
ticket ({{$ticket->name}}) Status changed .

Thanks,<br>
{{ config('app.name') }}
@endcomponent
