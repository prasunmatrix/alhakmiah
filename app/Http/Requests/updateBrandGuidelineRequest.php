<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Config;
class updateBrandGuidelineRequest extends FormRequest
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
        $brandGuidelineId =decrypt($this->encString, Config::get('Constant.ENC_KEY'));
        return [
            
            'title_en'	              => 'required',
            'title_ar'                => 'required',
            // 'pdf_upload'              => 'required',
            'status'                  => 'required',
            // 'thumbnail_image'         => 'required',
            // 'media'                   => 'required'.$brandGuidelineId
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                 => 'Title is required in English.',
            'title_ar.required'                                 => 'Title is required in Arbic.',
            // 'pdf_upload.required'                               => 'Please Upload Pdf.',
            'status.required'                                   =>'Status is required.',
            // 'thumbnail_image.required'                          => 'Pdf Thumbnail image is required.',
            // 'media.required'                                    => 'Please upload mp3 or wav or mpga audio file.',
            // 'media.mimes'                                       => 'Please upload mp3 or wav or mpga audio file.'
        ];
    }

}
