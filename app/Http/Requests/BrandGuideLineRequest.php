<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandGuideLineRequest extends FormRequest
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
            
            'title_en'	              => 'required',
            'title_ar'                => 'required',
            'pdf_upload'              => 'required',
            'status'                  => 'required',
            'thumbnail_image'         => 'required',
            'media'                   => 'required|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav'
            
        ];
    }
    public function messages()
    {
        return [
           
            
            'title_en.required'                                 => 'Title is required in English.',
            'title_ar.required'                                 => 'Title is required in Arbic.',
            'pdf_upload.required'                               => 'Please Upload Pdf.',
            'status.required'                                   =>'Status is required.',
            'thumbnail_image.required'                          => 'Pdf Thumbnail image is required.',
            'media.required'                                    => 'Media file is requird.',
            'media.mimes'                                       => 'Please upload mp3 or wav or mpga audio file.'
        ];
    }

}
