@component('mail::message')
{{ $details['title'] }}

{{ $details['description'] }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
