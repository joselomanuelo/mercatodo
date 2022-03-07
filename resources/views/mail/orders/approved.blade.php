@component('mail::message')
# Orden Aprovada

Tu orden fue aprovada, tu pedido está en camino.

@component('mail::button', ['url' => 'http://localhost:8000/'])
MercaTodo
@endcomponent

Muchas gracias,<br>
{{ config('app.name') }}
@endcomponent
