<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VitalSignRequest extends FormRequest
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
            'height'=>'required',
            'height_unit'=>'required',
            'weight'=>'required',
            'weight_unit'=>'required',
            'head_circumference'=>'required',
            'subscapular_circumference'=>'required',
            'edema'=>'required',
            'mesure_recumbent'=>'required'
        ];
    }

    public function message()
    {
        return [
            'height.required' => __('Height is required'),
            'weight.required' => __('Weight is required'),
            'head_circumference.required' => __('Head Circulference is required'),
            'triceps_circumference.required' => __('Triceps Circulference is required'),
            'edema.required' => __('Edima is required'),
            'mesure_recumbent.required' => __('Measured Recumbent is required'),
        ];

    }
}
