<?php

/*****************************************************/
# BlogBanner
# Page/Class name   : BlogBanner
# Author            :
# Created Date      : 04-04-2022
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BlogBanner extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];

}
