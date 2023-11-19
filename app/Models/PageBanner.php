<?php
/*****************************************************/
# PageBanner
# Page/Class name   : PageBanner
# Author            :
# Created Date      : 9-04-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];
    
                               
    
    


}