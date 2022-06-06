<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:products,name',
            'type' => 'required|in:ready,made',
            'is_active' => 'boolean',
            'is_cooking' => 'boolean',
            'selling_price' => 'required',
            'buying_price' => 'required_if:type,ready',
            'made_cost' => 'required_if:type,made',
            'made_in_order' => 'nullable',
            'start_quantity' => 'nullable|numeric',
          //  'material.*.quantity' => 'required|numeric',
            'unit_id' => 'nullable|numeric|exists:units,id',
            'notes' => 'nullable|string',
            'category_id' => 'required|numeric|exists:categories,id',
            'created_by' => 'nullable|numeric|exists:admins,id',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'name' => 'required|string|max:100|unique:products,name,'. $this->product->id,
                'type' => 'required|in:material,ready,made',
                'is_active' => 'boolean',
                'is_cooking' => 'boolean',
                'selling_price' => 'required|numeric',
                'buying_price' => 'required_if:type,ready',
                'made_cost' => 'required_if:type,made',
                'made_in_order' => 'required_if:type,made',
                'start_quantity' => 'nullable|numeric',
                'unit_id' => 'nullable|numeric|exists:units,id',
                'notes' => 'nullable|string',
                'category_id' => 'required|numeric|exists:categories,id',
                'created_by' => 'nullable|numeric|exists:admins,id',
                'image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,svg,gif|max:2048',
            ];
        }
        return $rules;
    }

    public function validated()
    {
        $data = parent::validated(); // TODO: Change the autogenerated stub
        $data['created_by'] = auth()->id();
        return $data;
    }
}
