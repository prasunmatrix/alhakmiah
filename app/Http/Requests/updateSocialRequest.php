<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateSocialRequest extends FormRequest
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
            
            'facebook'                                                    => 'required',
            'youtube'                                                     => 'required',
            'linkedin'                                                    => 'required',
            'instagram'                                                   => 'required',
            'twitter'                                                     => 'required',
            'whatsapp'                                                    => 'required',
            'contact_us_email'                                            => 'required',
            'join_us_email'                                               => 'required',
              
        ];
    }
    public function messages()
    {
        return [
           
            
            'facebook.required'                                    => 'facebook is required .',
            'youtube.required'                                     => 'youtube is required .',
            'linkedin.required'                                    => 'Description is required .',
            'instagram.required'                                   => 'Description is required .',
            'twitter.required'                                     => 'twitter is required .',
            'whatsapp.required'                                    => 'whatsapp is required .',
            'contact_us_email.required'                            => 'Contact Us Email is required .',
            'join_us_email.required'                               => 'Join Us Email is required .',

        ];
    }

}
