<?php

namespace App\Helpers;

use App\Events\OrderApprovedEvent;
use App\Events\OrderRejectedEvent;
use App\Models\Order;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class PlacetoPayHelper
{
    public static function attemptPayment(Order $order): Order
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
            'ipAddress' => app(Request::class)->getClientIp(),
            'userAgent' => substr(app(Request::class)->header('User-Agent'), 0, 255),
        ];

        try {
            $response = $placetopay->request($request);
            if ($response->isSuccessful()) {
                $order->process_url = $response->processUrl();
                $order->request_id = $response->requestId();
                $order->save();
            } else {
                dd($response->status()->message());
            }
        } catch (PlacetoPayException $e) {
            dd($e);
        }

        return $order;
    }

    public static function checkStatusPayment(Order $order)
    {
        $placetopay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'tranKey' => config('placetopay.tranKey'),
            'baseUrl' => config('placetopay.baseUrl'),
        ]);

        try {
            $response = $placetopay->query($order->request_id);
            if ($response->isSuccessful()) {
                if ($response->status()->isApproved()) {
                    $order->status = $response->status()->status();
                    $order->save();
                    event(new OrderApprovedEvent($order));
                } elseif ($response->status()->isRejected()) {
                    $order->status = $response->status()->status();
                    $order->save();
                    event(new OrderRejectedEvent($order));
                }
            } else {
                dd($response->status()->message());
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
