<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class CountryUpdateRequest extends FormRequest
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
        $countryId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
      
        return [
            
            'name_en'                                  => 'required|unique:countries,name_en,'.$countryId,
            'name_ar'                                 => 'required|unique:countries,name_ar,'.$countryId,
            'status'                                   => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'name_en.required'                            =>'Country name is required in English.',
            'name_en.unique'                              =>'Country name is already exists in English.',
            'name_ar.required'                            => 'Country name is required in Arbic.',
            'name_ar.unique'                              =>'Country name is already exists in Arbic.',
            'status.required'                             =>'Status is required.'

            
        ];
    }

}
