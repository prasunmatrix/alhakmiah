<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class CityUpdateRequest extends FormRequest
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
        $cityId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
        return [
            
            'name_en'                                  => 'required|unique:cities,name_en,'.$cityId,
            'name_ar'                                  => 'required|unique:cities,name_ar,'.$cityId,
            'status'                                   => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'name_en.required'                            =>'Country name is required in English.',
            'name_en.unique'                              =>'City name is already exists in English.',
            'name_ar.required'                            => 'Country name is required in Arbic.',
            'name_ar.unique'                              =>'City name is already exists in Arbic.',
            'status.required'                             =>'Status is required.'
      
          
            
        ];
    }

}
