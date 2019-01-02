
@component('mail::message')
# Introduction
<p>From        : {{$sender}}</p>
<p>Client name : {{$name}}</p>
<p>Phone       : {{$phone}}</p>
<p>{{$message}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
