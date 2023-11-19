<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class bannerRequest extends FormRequest
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
            
            'title_en'	                                         => 'required',
            'title_ar'                                           => 'required',
             //'banner'                                            => 'required',
             'banner'=>['required','mimes:jpeg,jpg,png,bmp,gif,mp4,mov,ogg,qt','max:500000',],
            'status'                                            => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                    => 'Title is required in English.',
            'title_ar.required'                                    => 'Title is required in Arbic.',
            // 'description_en.required'	                          => 'Description is required in English.',
             'banner.required'	                                  => 'banner is required .',
            'status.required'                                     =>'Status is required.'
            

          
            
        ];
    }

}
