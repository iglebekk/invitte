@component('mail::message')
# Velkommen

Du er lagt til som bruker av {{ config('app.name') }} med brukernavnet {{ $email }}.

[Fullfør brukeren din og velg passord her]({{ route('password', $token) }}).

Beste hilsen,<br>
{{ config('app.name') }}
@endcomponent
