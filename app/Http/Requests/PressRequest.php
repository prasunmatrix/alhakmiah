<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PressRequest extends FormRequest
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
            
            'title_en'	       => 'required',
            'title_ar'         => 'required',
            'press_image'      =>   'required',
            'status'           => 'required',
            'format_en'        => 'required',
            'format_ar'        => 'required'
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                    => 'Title is required in English.',
            'title_ar.required'                                    => 'Title is required in Arbic.',
            'press_image.required'                                 => 'Press Kit Image is required.',
            'status.required'                                      =>'Status is required.',
            'format_en.required'                                    => 'Format is required in English.',
            'format_ar.required'                                    => 'Format is required in Arbic.'
        ];
    }

}
