<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestorAchievementRequest extends FormRequest
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
            
            'financial_pdf'	                                      => 'required',
            'financial_pdf_ar'                                    => 'required',
            'annual_pdf'                                          => 'required',
            'annual_pdf_ar'                                       => 'required',
            'basel_pdf'                                            => 'required',
            'basel_pdf_ar'                                            => 'required',
            'profit_pdf'                                            => 'required',
            'profit_pdf_ar'                                            => 'required',
            'status'                                            => 'required',
            'year'                                            => 'required'
           
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'financial_pdf.required'	                              => 'Financial Pdf is required',
            'financial_pdf_ar.required'	                              => 'Financial Pdf is required in Arabic',
            'annual_pdf.required'                                   => 'Annual pdf isrequired',
            'annual_pdf_ar.required'                                => 'Annual pdf is required in Arabic',
            'basel_pdf.required'                                     => 'Basel Pdf isrequired',
            'basel_pdf_ar.required'                                 => 'Basel Pdf is required in Arabic',
            'profit_pdf.required'                                   => 'Profit pdf is required',
            'profit_pdf_ar.required'                                => 'Profit Pdf is required in Ar',
            'status.required'                                       =>'Status is required.',
            'year.required'                                       =>'Year is required.'
            


            // 'password.required'                             => 'Password is required.',
            // 'confirm_password.required'                     => 'Confirm Password is required.',
            // 'confirm_password.same'                         => 'Confirm Password should be same as password.'
          
            
        ];
    }

}
