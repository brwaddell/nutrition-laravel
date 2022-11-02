<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBirthInforRequest extends FormRequest
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
            'birth_weight' => 'required|numeric',
            'weight_unit' => 'required',
            'birth_length' => 'required|numeric',
            'length_unit' => 'required',
        ];
    }
}
