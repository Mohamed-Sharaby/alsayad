<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'code' => 'required|string|unique:sales,code,' . $this->sale->id,
            'client_id' => 'required|numeric|exists:clients,id',
            'date' => 'required|date|date_format:Y-m-d',
            'products' => 'required|array',
            'products.*.product_id' => 'required|numeric|exists:products,id',
            'products.*.quantity' => 'required|numeric',
            'products.*.product_price' => 'required|numeric',
            'products.*.total_product_price' => 'required|numeric',
            'products.*.cooking_id' => 'nullable|numeric|exists:cookings,id',
            'products.*.cooking_price' => 'nullable|numeric',
            'total' => 'required|numeric',
            'notes' => 'nullable|string',
            'is_points' => 'boolean',
        ];
    }


}
