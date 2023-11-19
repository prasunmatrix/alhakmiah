<?php
/*****************************************************/
# Cms
# Page/Class name   : Cms
# Author            :
# Created Date      : 15-07-2020
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{

        protected $appends = ['local_created_at'];
        use SoftDeletes;
        protected $dates = ['deleted_at'];

        public function SliderImage(){
          return $this->hasMany('App\Models\CmsImage', 'cms_id');
        }                     
    
    


}