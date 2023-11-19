<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContsSettingsRequest extends FormRequest
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
    public function rules(){

     return [
            
            'contact_us_text_en'                                         => 'required',
            'contact_us_text_ar'                                         => 'required',
            'contact_us_map'                                             => 'required',
          
        ];
    }
    public function messages()
    {
        return [
           
            
            'contact_us_text_en.required'                                     => 'Contact Us Text  is required in English.',
            'contact_us_text_ar.required'                                     => 'Contact Us Text is required in Arabic.',
            'contact_us_map.required'                                         => 'Contact us Map  is required .',
          

        ];
    }

}
