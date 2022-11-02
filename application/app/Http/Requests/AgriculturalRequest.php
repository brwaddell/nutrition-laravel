<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgriculturalRequest extends FormRequest
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
            'growing_food' => 'required',
            'own_rent' => 'required',
            'area_size' => 'required',
            'land_condition' => 'required',
            'irrigation' => 'required',
            'grow_food' => 'required',
            'crops_kind' => 'required',
            'animal_husbandry' => 'required',
            'compost' => 'required',
            'seed_uses' => 'required',
            'fertilisers' => 'required',
            'decrease_production' => 'required',
            'pets' => 'required',
            'explain' => 'required'
        ];
    }
}
