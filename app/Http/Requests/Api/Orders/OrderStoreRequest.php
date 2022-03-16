<?php

namespace App\Http\Requests\Api\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->has('order_id')) {
            return [
                'order_id' => ['required', 'numeric'],
            ];
        } else {
            return [
                'order' => ['required', 'string'],
                'price' => ['required', 'numeric'],
            ];
        }
    }
}
