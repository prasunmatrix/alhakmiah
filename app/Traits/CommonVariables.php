<?php
namespace App\Traits;
use App\Models\Cms;

trait CommonVariables
{
    public function shareVariables() {
        //Getting meta variable: START
        $cmsRecords = Cms::get();
        foreach($cmsRecords as $rec){
            $metaDetail[$rec['slug_name']]['title'] = $rec['meta_title'];
            $metaDetail[$rec['slug_name']]['title_ar'] = $rec['meta_title_ar'];
            $metaDetail[$rec['slug_name']]['meta_descriptions'] = $rec['meta_descriptions'];
            $metaDetail[$rec['slug_name']]['meta_descriptions_ar'] = $rec['meta_descriptions_ar'];
            $metaDetail[$rec['slug_name']]['meta_keyword'] = $rec['meta_keyword'];
            $metaDetail[$rec['slug_name']]['meta_keyword_ar'] = $rec['meta_keyword_ar'];
            $metaDetail[$rec['slug_name']]['alt_text'] = $rec['alt_text'];
            $metaDetail[$rec['slug_name']]['alt_text_ar'] = $rec['alt_text_ar'];
            $metaDetail[$rec['slug_name']]['canonical'] = $rec['canonical'];
            $metaDetail[$rec['slug_name']]['canonical_ar'] = $rec['canonical_ar'];
           
            
        }

        //Getting meta variable: End

        \View::share([
            'projectSlug'         	=> $this->projectSlug ?? '',
            'communityDetailsSlug'  => $this->communityDetailsSlug ?? '',
            'metaDetail'             => $metaDetail,
        ]);
    }

}