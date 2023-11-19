<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function rules()
    {
        return [
            
            'social_link_en'                                            => 'required',
            'social_link_ar'                                           => 'required',
           
            'status'                                            => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'social_link_en.required'                                    => 'Title is required in English.',
            'social_link_ar.required'                                    => 'Title is required in Arbic.',
          
          
            
        ];
    }

}
