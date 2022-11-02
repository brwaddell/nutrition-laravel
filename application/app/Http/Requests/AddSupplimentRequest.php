<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSupplimentRequest extends FormRequest
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
            'suppliment_id' => 'required|integer',
            'description' => 'required',
            'per_day_qty' => 'required',
            'period' => 'required',
            'dosage_form' => 'required',
            'patient_id' => 'required|integer',
        ];
    }
}
