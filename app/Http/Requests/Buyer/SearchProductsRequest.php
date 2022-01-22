<?php

namespace App\Http\Requests\Buyer;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'string',
            'category' => 'numeric',
            'priceFrom' => 'numeric',
            'priceTo' => 'numeric',
        ];
    }
}
