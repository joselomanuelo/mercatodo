@component('mail::message')
# Orden Rechazada

Tu orden fue rechazada o declinada, te invitamos a reintentar el pago.

@component('mail::button', ['url' => 'http://localhost:8000/'])
MercaTodo
@endcomponent

Muchas Gracias,<br>
{{ config('app.name') }}
@endcomponent
