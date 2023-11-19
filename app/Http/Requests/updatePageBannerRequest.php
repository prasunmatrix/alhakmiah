<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatePageBannerRequest extends FormRequest
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
            
            'title'                                             => 'required',

            'banner'                                             => 'required',

       
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title.required'                                    => 'Title is required in English.',
          
            'banner.required'                                   => 'banner is required .',
   
            

          
            
        ];
    }

}
