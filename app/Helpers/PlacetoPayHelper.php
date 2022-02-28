<?php

namespace App\Helpers;

use App\Models\Order;
use Dnetix\Redirection\PlacetoPay;

class PlacetoPayHelper
{
    public static function attempPayment(Order $order): Order
    {
        $placetopay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'tranKey' => config('placetopay.tranKey'),
            'baseUrl' => config('placetopay.baseUrl'),
        ]);

        $reference = $order->id;

        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Mercatodo payment',
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->price,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://localhost:8000/buyer/orders/show/'.$reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        $response = $placetopay->request($request);

        if ($response->isSuccessful()) {
            $order->process_url = $response->processUrl();
            $order->request_id = $response->requestId();
            $order->save();
        } else {
            dd($response->status()->message());
        }

        return $order;
    }
}
