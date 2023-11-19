<?php
/*****************************************************/
# MediaTab
# Page/Class name   : MediaTab
# Author            :
# Created Date      : 19-07-2021
# Functionality     : Table declaration
# Purpose           : Table declaration
/*****************************************************/
namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class MediaTab extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $appends = ['local_created_at'];
}