@component('mail::message')
# Confirmación de Contacto

Hola {{ $quote->name }},

Gracias por escribirnos, queremos confirmar que hemos recibido tu mensaje. Realizaremos la cotizacion y nos pondremos en contacto contigo lo más pronto posible.

Gracias por preferirnos.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
