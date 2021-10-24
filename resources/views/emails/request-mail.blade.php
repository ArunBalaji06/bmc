@component('mail::message')
{{ $details['title'] }}

<br>
{{ $details['description'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
