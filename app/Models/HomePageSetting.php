<?php
/*****************************************************/
# HomePageSetting
# Page/Class name   : HomePageSetting
# Author            :
# Created Date      : 30-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Support\Str;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{

    
       
    
        
    
      //   public $sortable = ['id',
      //                       'name_en',
      //                       'name_ar',
      //                       'created_at',
      //                       ];
        protected $appends = ['local_created_at'];
    
                               
    
    


}