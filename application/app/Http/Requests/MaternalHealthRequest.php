<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaternalHealthRequest extends FormRequest
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
            'menarche_age' => 'required|integer',
            'last_menstrual_period' => 'required',
            'menstrual_pattern' => 'required',
            'cycle_length' => 'required',
            'duration_flow' => 'required',
            'amount_flow' => 'required',
            'pain' => 'required',
            'bleeding' => 'required',
            'vasmotor' => 'required',
            'hormone_therapy' => 'required',
            'menopause' => 'required',
            'bleeding_pattern' => 'required',
            'contraception' => 'required',
            'contraception_method' => 'required',
            'previous_contraception_method' => 'required',
            'pap_smear_result' => 'required',
            'pap_smear_history' => 'required',
            'infections_history' => 'required',
            'sti_history' => 'required',
            'vaginitis_history' => 'required',
            'pelvic_history' => 'required',
            'fertility' => 'required',
            'desire_fertility' => 'required',
            'diagnosis' => 'required',
            'explain' => 'required',
            'include_types_one' => 'required',
            'difficulty' => 'required',
        ];
    }
}
