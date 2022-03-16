<?php

namespace App\Helpers;

use App\Events\OrderApproved;
use App\Events\OrderRejected;
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
                'description' => $order->reference,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->price,
                ],
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'returnUrl' => 'http://localhost:8000/buyer/orders/show/' . $reference,
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

    public static function statusPayment(Order $order)
    {
        $placetopay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'tranKey' => config('placetopay.tranKey'),
            'baseUrl' => config('placetopay.baseUrl'),
        ]);

        $response = $placetopay->query($order->request_id);

        if ($response->isSuccessful()) {

            if ($response->status()->isApproved()) {
                $order->status = $response->status()->status();
                $order->save();
                event(new OrderApproved($order));
            } elseif ($response->status()->isRejected()) {
                $order->status = $response->status()->status();
                $order->save();
                event(new OrderRejected($order));
            }
        } else {
            dd($response->status()->message());
        }
    }
}
