<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantInvoiceRequest extends FormRequest
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
        $rules = [
            'code' => 'required|string|unique:storage_invoices,code',
            'date' => 'required|date|date_format:Y-m-d',
            'total' => 'required',
            'created_by' => 'nullable|numeric|exists:admins,id',
            'products' => 'required|array',
            //'products.*.quantity' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'code' => 'required|string|unique:storage_invoices,code,'.$this->restaurant_invoice->id,
                'date' => 'required|date|date_format:Y-m-d',
                'total' => 'required',
                'created_by' => 'nullable|numeric|exists:admins,id',
                'products' => 'required|array',
                'notes' => 'nullable|string',
            ];
        }
        return $rules;
    }

    public function validated()
    {
        $data = parent::validated(); // TODO: Change the autogenerated stub
        $data['created_by'] = auth()->id();
        $data['type'] = 'out';

        return $data;
    }

}
