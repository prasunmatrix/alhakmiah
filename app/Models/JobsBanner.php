<?php
/*****************************************************/
# JobsBanner
# Page/Class name   : JobsBanner
# Author            :
# Created Date      : 9-04-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class JobsBanner extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];
    
                               
    
    


}