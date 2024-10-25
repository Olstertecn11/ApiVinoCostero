@component('mail::message')
# Confirmación de Contacto

Hola {{ $contact->name }},

Gracias por escribirnos, queremos confirmar que hemos recibido tu mensaje. Nos pondremos en contacto contigo lo más pronto posible.

Gracias por preferirnos.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
