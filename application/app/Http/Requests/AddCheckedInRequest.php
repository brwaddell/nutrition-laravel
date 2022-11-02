<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCheckedInRequest extends FormRequest
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
            'patient_id' => 'required|integer',
            'doctor_id' => 'required|integer',
            'reason' => 'required',
        ];
    }

    public function message()
    {
        return [
            'patient_id.required' => __('Patient is required'),
            'doctor_id.required' => __('Doctor is required'),
        ];

    }
}
