<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest
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
            
            'name_en'	                                        => 'required',
            'name_ar'                                           => 'required',
            'description_ar'                                    => 'required',
            'description_en'                                    => 'required',
            //'banner_image'                                      => 'required',
            // 'banner_image'=>['required','mimes:jpeg,jpg,png,bmp,gif','max:10240',],
            'status'                                            => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'name_en.required'                                    => 'Name is required in English.',
            'name_ar.required'                                    => 'Name is required in Arbic.',
            'description_en.required'	                          => 'Description is required in English.',
            'description_ar.required'	                          => 'Description is required in Arbic.',
            // 'banner_image.required'                               => 'banner image is required .',
            'status.required'                                     =>'Status is required.',
            


        
          
            
        ];
    }

}
