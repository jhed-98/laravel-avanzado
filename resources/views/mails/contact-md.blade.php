<!-- prettier-ignore -->
@component('mail::message')
# Contact Form

{{ $data['name'] }} te ha enviado un mensaje desde la web de Laravel
@component('mail::panel')
    {{ $data['mensaje'] }}
@endcomponent

Correo de contacto: {{ $data['email'] }}

@endcomponent
