<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntermittentHealthRequest extends FormRequest
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
            'diarrhealasttwoweeks'=>'required',
            'stoolswithbloodormucus'=>'required',
            'morethanthreediarrhealstoolorliquid'=>'required',
            'toiletmorethantimesthanusual'=>'required',
            'acutegastrointestinalinfection'=>'required',
            'hadstoolswithbloodormucus'=>'required',
            'diarrhealast'=>'required',
        ];
    }

    public function message()
    {
        return[
            'diarrhealast.required'=>'How long does the diarrhea last field is required'
        ];
    }
}
