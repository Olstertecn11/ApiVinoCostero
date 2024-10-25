@component('mail::message')
# Respuesta a tu cotización

Hola {{ $request->name }},

Es un gusto saludarte, a continuación te presentamos la respuesta a tu cotización:

@component('mail::panel')
{{ $request->description }}
@endcomponent

<br>
Nuesta respuesta es la siguiente:
@component('mail::panel')
{{ $request->message }}
@endcomponent


Para nosotros es un gusto servirte, si tienes alguna duda o pregunta no dudes en contactarnos.
<br>
{{ config('app.url') }}

Gracias por preferirnos.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
