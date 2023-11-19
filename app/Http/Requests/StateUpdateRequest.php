<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class StateUpdateRequest extends FormRequest
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
        $stateId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
        return [
            
            'name_en'                                  => 'required|unique:states,name_en,'.$stateId,
            'name_ar'                                  => 'required|unique:states,name_ar,'.$stateId,
            'status'                                   => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'name_en.required'                            =>'States name is required in English.',
            'name_en.unique'                              =>'States name is already exists in English.',
            'name_ar.required'                            => 'States name is required in Arbic.',
            'name_ar.unique'                              =>'States name is already exists in Arbic.',
            'status.required'                             =>'Status is required.'
  
          
            
        ];
    }

}
