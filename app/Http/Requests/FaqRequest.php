<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            
            'question_en'	                               => 'required',
            'answer_en'                                    => 'required',
            'question_ar'                                  => 'required',
            'answer_ar'                                    => 'required',
            'status'                                       => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'question_en.required'                            => 'Name is required in English.',
            'answer_en.required'                              => 'Name is required in Arbic.',
            'question_ar.required'	                          => 'Description is required in English.',
            'answer_ar.required'	                          => 'Description is required in Arbic.',
            'status.required'                                 =>'Status is required.'
            


            // 'password.required'                             => 'Password is required.',
            // 'confirm_password.required'                     => 'Confirm Password is required.',
            // 'confirm_password.same'                         => 'Confirm Password should be same as password.'
          
            
        ];
    }

}
