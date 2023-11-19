<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class UpdatePresskitRequest extends FormRequest
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
        $pressKitId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
        return [
            
            'title_en'	                                        => 'required',
            'title_ar'                                          => 'required',
            'format_en'                                         => 'required',
            'format_ar'                                         => 'required',
            // 'press_image'                                       => 'required,'.$pressKitId,
            'status'                                            => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                    => 'Title is required in English.',
            'title_ar.required'                                    => 'Title is required in Arbic.',
            // 'press_image.required'                                 => 'Press Kit Image is required.',
            'status.required'                                      =>'Status is required.',
            'format_en.required'                                    => 'Format is required in English.',
            'format_ar.required'                                    => 'Format is required in Arbic.'
      
        ];
    }

}
