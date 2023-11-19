<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
            
            'name_en'	                               => 'required|unique:states,name_en',
            'name_ar'                                  => 'required|unique:states,name_ar',
            'status'                                   => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'name_en.required'                            =>'States name is required in English.',
            'name_en.unique'                              =>'States name is already exists in English.',
            'name_ar.required'                            =>'States name is required in Arbic.',
            'name_ar.unique'                              =>'States name is already exists in Arbic.',
            'status.required'                             =>'Status is required.'
            


            // 'password.required'                             => 'Password is required.',
            // 'confirm_password.required'                     => 'Confirm Password is required.',
            // 'confirm_password.same'                         => 'Confirm Password should be same as password.'
          
            
        ];
    }

}
