<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaternalHistoryRequest extends FormRequest
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
            'height' => 'required|numeric',
            'height_unit' => 'required',
            'weight' => 'required|numeric',
            'weight_unit' => 'required',
            'abdominal_circumference' => 'required|numeric',
            'circum_unit' => 'required',
            'bmi' => 'required|numeric',
            'schooling' => 'required',
            'occupation' => 'required',
            'martial_status' => 'required',
            'father_live' => 'required',
            'provide_expenses' => 'required',
            'us_migrant' => 'required',
            'remittance_send' => 'required',
            'age_sex' => 'required|numeric',
            'age_first_child' => 'required|numeric',
            'interpregnancy_period' => 'required',
            'children' => 'required|integer',
            'partner_children' => 'required|integer',
            'age_pregnancy' => 'required|numeric',
            'contraception' => 'required',
            'child_planning' => 'required|integer',
            'alcohol' => 'required',
            'substance_abuse' => 'required',
            'family_members' => 'required|integer'

        ];
    }
}
