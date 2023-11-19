<?php
/*****************************************************/
# News
# Page/Class name   : News
# Author            :
# Created Date      : 31-03-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //protected $appends = ['local_created_at'];
    
                               
    
    


}