@component('mail::message')
# Confirmación de Pedido

Hola {{ $order->user->name }},

Gracias por tu pedido. Aquí están los detalles:

@component('mail::table')
| Producto       | Cantidad   | Precio   |
| -------------- |:----------:| --------:|
@foreach ($order->items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | Q.{{ number_format($item->price, 2) }} |
@endforeach
@endcomponent

**Total:** Q.{{ number_format($order->total, 2) }}

Gracias por comprar con nosotros.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
