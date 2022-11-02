<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddParentRequest extends FormRequest
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
            'parent_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required|date',
            'language' => 'required',
            'martial_status' => 'required',
            'district' => 'required',
            'dpi_number' => 'numeric',
            'occupation' => 'required',
            'migrant' => 'required',
            'primary_caregiver' => 'required',
            'caregiver_info' => 'required'
        ];
    }
}
