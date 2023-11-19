<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class HomePageGalleryRequest extends FormRequest
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
        $imageId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
        return [
            
            'title_en'	                                        => 'required',
            'title_ar'                                           => 'required',
            'description_ar'                                    => 'required',
            'description_en'                                    => 'required', 
            //'image'                                             => 'required'.$imageId, 

            
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                    => 'Title is required in English.',
            'title_ar.required'                                    => 'Title is required in Arbic.',
            'description_en.required'	                          => 'Description is required in English.',
            'description_ar.required'	                          => 'Description is required in Arbic.',
            // 'image.required'                                      => 'image is required in English.',

          
            
        ];
    }

}
