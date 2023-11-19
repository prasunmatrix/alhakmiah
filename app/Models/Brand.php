<?php
/*****************************************************/
# Brand
# Page/Class name   : Brand
# Author            :
# Created Date      : 24-08-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //protected $appends = ['local_created_at'];
    
                               
    
    


}