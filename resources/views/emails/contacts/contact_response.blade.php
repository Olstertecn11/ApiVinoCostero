@component('mail::message')
# Respuesta a tu Contacto

Hola {{ $request->name }},

Es un gusto saludarte, a continuación te presentamos la respuesta a de tu contacto:

@component('mail::panel')
{{ $request->description }}
@endcomponent

<br>
Nuesta respuesta es la siguiente:
@component('mail::panel')
{{ $request->message }}
@endcomponent


Para nosotros es un gusto servirte, si tienes alguna duda o pregunta no dudes en contactarnos nuevamente.
<br>
{{ config('app.url') }}

Gracias por preferirnos.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
