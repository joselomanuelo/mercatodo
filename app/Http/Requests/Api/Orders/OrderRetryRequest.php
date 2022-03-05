<?php

namespace App\Http\Requests\Api\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRetryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'order_id' => ['required', 'numeric'],
        ];
    }
}
