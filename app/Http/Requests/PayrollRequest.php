<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
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
            'date' => 'required|date',
            'admin_id' => 'required|numeric|exists:admins,id',
            'type'=>'required|in:salary,increase,deduction',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
        ];

        if ($this->method() == 'PUT') {
            $rules = [
                'date' => 'required|date',
                'admin_id' => 'required|numeric|exists:admins,id',
                'type'=>'required|in:salary,increase,deduction',
                'amount' => 'required|numeric',
                'notes' => 'nullable|string',
            ];
        }
        return $rules;
    }

}
