<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSettingRequest extends FormRequest
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
            
            'title_en'	                                        => 'required',
            'title_ar'                                           => 'required',
            'description_ar'                                    => 'required',
            'description_en'                                    => 'required', 
          

            
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                    => 'Title is required in English.',
            'title_ar.required'                                    => 'Title is required in Arbic.',
            'description_en.required'	                          => 'Description is required in English.',
            'description_ar.required'	                          => 'Description is required in Arbic.',
           
          
            
        ];
    }

}
