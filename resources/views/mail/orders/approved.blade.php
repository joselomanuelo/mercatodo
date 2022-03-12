@component('mail::message')
# Orden Aprobada

Tu orden fue aprobada, tu pedido está en camino.

@component('mail::button', ['url' => 'http://localhost:8000/'])
MercaTodo
@endcomponent

Muchas gracias,<br>
{{ config('app.name') }}
@endcomponent
