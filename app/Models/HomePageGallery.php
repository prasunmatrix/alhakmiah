<?php
/*****************************************************/
# HomePageGallery
# Page/Class name   : HomePageGallery
# Author            :
# Created Date      : 31-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class HomePageGallery extends Model
{


        protected $table = 'home_page_galleries';
	    use SoftDeletes;
	    protected $dates = ['deleted_at'];
	    protected $appends = ['local_created_at'];

        public function Gallery(){
            return $this->hasMany('App\Models\HomeImage', 'home_id');
        }  
    
                               
    
    


}